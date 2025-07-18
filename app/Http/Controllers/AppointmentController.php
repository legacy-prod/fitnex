<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Banner;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;
use UnexpectedValueException;

class AppointmentController extends Controller
{
    public function __construct()
    {
        /* $this->middleware('auth'); */
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    public function index()
    {
        $appointments = collect(); // Default to an empty collection
        if (Auth::check()) {
            $appointments = Appointment::where('user_id', Auth::id())
                ->with('trainer')
                ->latest()
                ->paginate(10);
        }

        return view('website.appointment.index', [
            'models' => $appointments,
            'page_title' => 'My Appointments',
        ]);
    }

    public function create(Request $request)
    {
        $trainer = Trainer::findOrFail($request->trainer_id);
        $banner = Banner::where('slug', request()->route()->getName())->where('status', 1)->first();
        return view('website.appointment.create', [
            'trainer' => $trainer,
            'page_title' => 'Book a Session with ' . $trainer->name,
            'banner' => $banner,
        ]);
    }

    public function store(Request $request)
    {
        $validationRules = [
            'trainer_id' => 'required|exists:trainers,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|date_format:H:i',
            'time_zone' => 'required|string',
        ];

        if (!Auth::check()) {
            $validationRules['name'] = 'required|string|max:255';
            $validationRules['email'] = 'required|email|max:255|unique:users,email';
        }
        
        $request->validate($validationRules);
        
        // Additional validation for past time slots on today's date
        if ($request->appointment_date === date('Y-m-d')) {
            $currentTime = date('H:i');
            if ($request->appointment_time <= $currentTime) {
                return redirect()->back()
                    ->with('error', 'Cannot book appointments for past time slots.')
                    ->withInput();
            }
        }

        $trainer = Trainer::findOrFail($request->trainer_id);
        
        // Check for conflicting appointments
        $existingAppointment = Appointment::where('trainer_id', $request->trainer_id)
            ->where('appointment_date', $request->appointment_date)
            ->where('appointment_time', $request->appointment_time)
            ->whereIn('status', ['confirmed', 'pending'])
            ->first();

        if ($existingAppointment) {
            return redirect()->back()->with('error', 'This time slot is no longer available. Please choose a different time.')->withInput();
        }
        
        $user = Auth::user();
        $customerEmail = Auth::check() ? $user->email : $request->email;

        if (!$user) {
            $user = User::firstOrCreate(
                ['email' => $request->email],
                [
                    'name' => $request->name,
                    'password' => Hash::make(Str::random(12)), // Create a random password
                ]
            );
        }

        if ($trainer->price > 0) {
            $appointment = Appointment::create([
                'user_id' => $user->id,
                'trainer_id' => $trainer->id,
                'appointment_date' => $request->appointment_date,
                'appointment_time' => $request->appointment_time,
                'time_zone' => $request->time_zone,
                'price' => $trainer->price,
                'status' => 'pending',
                'description' => $request->description,
                'payment_status' => 'pending',
            ]);
    
            try {
                $checkout_session = Session::create([
                    'payment_method_types' => ['card'],
                    'line_items' => [[
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => 'Session with ' . $trainer->name,
                                'description' => '1-on-1 training session.',
                            ],
                            'unit_amount' => $trainer->price * 100,
                        ],
                        'quantity' => 1,
                    ]],
                    'mode' => 'payment',
                    'success_url' => route('payment.success', ['appointment_id' => $appointment->id]) . '?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url' => route('payment.cancel', ['appointment_id' => $appointment->id]),
                    'customer_email' => $customerEmail,
                    'client_reference_id' => $appointment->id,
                ]);
    
                $appointment->stripe_session_id = $checkout_session->id;
                $appointment->save();
    
                return redirect($checkout_session->url);
            } catch (\Exception $e) {
                Log::error('Stripe Checkout Error: ' . $e->getMessage());
                $appointment->delete();
                return redirect()->back()->with('error', 'Could not initiate payment. Please try again.');
            }
        } else {
            // For free appointments, book directly without payment
            Appointment::create([
                'user_id' => $user->id,
                'trainer_id' => $trainer->id,
                'appointment_date' => $request->appointment_date,
                'appointment_time' => $request->appointment_time,
                'time_zone' => $request->time_zone,
                'price' => 0,
                'status' => 'confirmed',
                'description' => $request->description,
                'payment_status' => 'not_required',
            ]);
    
            // TODO: Add email notifications for free bookings
    
            return redirect()->route('appointments.index')->with('success', 'Your free session has been booked successfully!');
        }
    }

    public function paymentSuccess(Request $request)
    {
        $sessionId = $request->get('session_id');
        $appointmentId = $request->get('appointment_id');
        
        if (!$sessionId || !$appointmentId) {
            return redirect()->route('appointments.index')->with('error', 'Invalid payment session. Please contact support.');
        }

        try {
            $session = Session::retrieve($sessionId);
            $appointment = Appointment::findOrFail($appointmentId);

            // Ensure we are updating the correct appointment
            if ($appointment->stripe_session_id !== $sessionId) {
                 Log::warning("Mismatched session ID for appointment {$appointmentId}.");
                 return redirect()->route('appointments.index')->with('error', 'Invalid session ID. Payment confirmation failed.');
            }

            if ($session->payment_status == 'paid' && $appointment->status === 'pending') {
                $appointment->payment_status = 'completed';
                $appointment->status = 'confirmed';
                $appointment->save();

                // You can add email notifications to user and trainer here
                // Mail::to($appointment->user->email)->send(new AppointmentConfirmedMail($appointment));
                // Mail::to($appointment->trainer->user->email)->send(new NewAppointmentForTrainerMail($appointment));
                Log::info("Appointment {$appointment->id} confirmed directly via success URL.");

                return redirect()->route('appointments.index')->with('success', 'Booking and payment successful!');
            } elseif ($appointment->status === 'confirmed') {
                // Handle cases where the user revisits the success URL
                return redirect()->route('appointments.index')->with('success', 'Your booking was already confirmed.');
            }
            else {
                // If payment was not successful, redirect to the cancellation page
                return redirect()->route('payment.cancel', ['appointment_id' => $appointmentId])->with('error', 'Payment was not successful. Please try again.');
            }
        } catch (\Exception $e) {
            Log::error('Stripe Success Error: ' . $e->getMessage());
            return redirect()->route('appointments.index')->with('error', 'An error occurred while confirming your payment.');
        }
    }

    public function paymentCancel(Request $request)
    {
        $appointment = Appointment::find($request->get('appointment_id'));

        if ($appointment && $appointment->payment_status === 'pending') {
            $appointment->status = 'cancelled';
            $appointment->save();
        }

        return redirect()->route('appointments.index')->with('error', 'Payment was cancelled. Your booking has not been confirmed.');
    }

    public function getAvailableTimes($trainer_id, $date)
    {
        try {
            $trainer = Trainer::findOrFail($trainer_id);
            
            // Check if the selected date is in the past
            if (strtotime($date) < strtotime('today')) {
                return response()->json([]);
            }
            
            // Define the trainer's general availability (you could make this configurable per trainer)
            $startTime = strtotime('09:00');
            $endTime = strtotime('17:00');
            $slotInterval = 30 * 60; // 30 minutes in seconds

            $allSlots = [];
            for ($time = $startTime; $time <= $endTime; $time += $slotInterval) {
                $allSlots[] = date('H:i', $time);
            }

            // Get booked times for this trainer and date
            $bookedTimes = Appointment::where('trainer_id', $trainer_id)
                ->where('appointment_date', $date)
                ->whereIn('status', ['confirmed', 'pending'])
                ->pluck('appointment_time')
                ->map(function ($time) {
                    return date('H:i', strtotime($time)); // Ensure H:i format
                })
                ->toArray();
            
            // Filter out past times for today
            if ($date === date('Y-m-d')) {
                $currentTime = date('H:i');
                $allSlots = array_filter($allSlots, function($slot) use ($currentTime) {
                    return $slot > $currentTime;
                });
            }
            
            $availableSlots = array_diff($allSlots, $bookedTimes);
            
            return response()->json(array_values($availableSlots));

        } catch (\Exception $e) {
            Log::error("Error fetching available times: " . $e->getMessage());
            return response()->json(['error' => 'Could not fetch available times.'], 500);
        }
    }
}

