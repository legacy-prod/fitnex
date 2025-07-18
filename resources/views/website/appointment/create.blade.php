@extends('layouts.website.master')
@section('title', $page_title)

@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
    .booking-form {
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }
    
    .form-input {
        background: rgba(255, 255, 255, 0.1);
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        color: white;
        transition: all 0.3s ease;
    }
    
    .form-input:focus {
        border-color: #0079D4;
        box-shadow: 0 0 0 3px rgba(0, 121, 212, 0.1);
        outline: none;
        background: rgba(255, 255, 255, 0.15);
    }
    
    .form-input::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }
    
    .time-slot-btn {
        background: rgba(255, 255, 255, 0.1);
        border: 2px solid rgba(255, 255, 255, 0.2);
        color: white;
        border-radius: 10px;
        padding: 12px 16px;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .time-slot-btn:hover {
        background: rgba(0, 121, 212, 0.2);
        border-color: #0079D4;
        transform: translateY(-2px);
    }
    
    .time-slot-btn.selected {
        background: #0079D4 !important;
        border-color: #0079D4 !important;
        box-shadow: 0 4px 15px rgba(0, 121, 212, 0.4);
    }
    
    .trainer-card {
        background: linear-gradient(135deg, #2d2d2d 0%, #1a1a1a 100%);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }
    
    .primary-btn {
        background: linear-gradient(135deg, #0079D4 0%, #005a9f 100%);
        border: none;
        border-radius: 12px;
        padding: 16px 32px;
        font-weight: 700;
        font-size: 18px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 121, 212, 0.3);
    }
    
    .primary-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 121, 212, 0.4);
    }
    
    .primary-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }
    
    .error-message {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        border-radius: 10px;
        padding: 16px;
        margin-bottom: 20px;
        border-left: 4px solid #a71e2a;
    }
    
    .success-message {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border-radius: 10px;
        padding: 16px;
        margin-bottom: 20px;
        border-left: 4px solid #1e7e34;
    }
    
    .form-label {
        font-weight: 600;
        margin-bottom: 8px;
        color: #f8f9fa;
        font-size: 16px;
    }
    
    .loading-spinner {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 1s ease-in-out infinite;
    }
    
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
</style>
@endpush

@section('content')
<section class="inner-banner listing-banner" style="background: url('{{ ($banner && $banner->image) ? asset('/admin/assets/images/banner/'.$banner->image) : asset('/admin/assets/images/images.png') }}') no-repeat center/cover">
    <div class="container">
        <h1 class="relative mx-auto text-[50px] text-white font-bold leading-[1.1]" data-aos="flip-right" data-aos-easing="linear" data-aos-duration="1500">
            @php
                $title = ($banner && $banner->name) ? $banner->name : 'Book Session';
                $parts = explode(' ', $title, 2);
            @endphp
            <span class="italic uppercase font-black">
                <span class="primary-theme-text">{{ $parts[0] }}</span>@if(isset($parts[1])) {{ $parts[1] }}@endif
            </span>
        </h1>
    </div>
</section>

<section class="py-16 bg-black text-white">
    <div class="container">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div>
                <h2 class="text-3xl font-bold mb-4">Trainer Information</h2>
                <div class="flex items-center space-x-4 mb-6">
                    <img src="{{ asset('/admin/assets/images/Trainers/'.$trainer->image) }}" alt="{{ $trainer->name }}" class="w-24 h-24 rounded-full object-cover">
                    <div>
                        <h3 class="text-2xl font-bold">{{ $trainer->name }}</h3>
                        <p class="text-lg text-[#0079D4]">{{ $trainer->designation }}</p>
                        <p class="text-lg font-bold primary-theme">${{ $trainer->price }} / session</p>
                    </div>
                </div>
                <div class="prose prose-invert max-w-none">
                    {!! $trainer->description !!}
                </div>
            </div>
            <div>
                <h2 class="text-3xl font-bold mb-4">Book Your Session</h2>
                @if(session('error'))
                    <div class="bg-red-500 text-white p-4 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif
                <form action="{{ route('appointments.store') }}" id="regform" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    @csrf
                    <input type="hidden" name="trainer_id" value="{{ $trainer->id }}">
                    
                    @guest
                    <div class="mb-4">
                        <label for="name" class="block text-lg font-medium mb-2">Full Name</label>
                        <input type="text" id="name" name="name" class="w-full bg-gray-800 border-gray-600 rounded p-3" placeholder="Enter your name" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-lg font-medium mb-2">Email Address</label>
                        <input type="email" id="email" name="email" class="w-full bg-gray-800 border-gray-600 rounded p-3" placeholder="Enter your email" required>
                    </div>
                    @endguest

                    <div class="mb-4">
                        <label for="appointment_date" class="block text-lg font-medium mb-2">Select Date</label>
                        <input type="text" id="appointment_date" name="appointment_date" class="w-full bg-gray-800 border-gray-600 rounded p-3" placeholder="Select a date" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-lg font-medium mb-2">Select Time</label>
                        <input type="hidden" name="appointment_time" id="appointment_time" required>
                        <div id="time-slots-container" class="grid grid-cols-3 sm:grid-cols-4 gap-2">
                            <p class="text-gray-400 col-span-full">Please select a date to see available times.</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="time_zone" class="block text-lg font-medium mb-2">Your Timezone</label>
                        <input type="text" id="time_zone" name="time_zone" class="w-full bg-gray-800 border-gray-600 rounded p-3" readonly required>
                    </div>
                    
                    <div class="mb-6">
                        <label for="description" class="block text-lg font-medium mb-2">Additional Notes (Optional)</label>
                        <textarea id="description" name="description" rows="4" class="w-full bg-gray-800 border-gray-600 rounded p-3"></textarea>
                    </div>

                    <button type="submit" class="btn primary-btn w-full">Proceed to Payment</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
(function() {
    document.addEventListener('DOMContentLoaded', function() {
        const trainerId = document.querySelector('input[name="trainer_id"]').value;
        const dateInput = document.getElementById('appointment_date');
        const timeSlotsContainer = document.getElementById('time-slots-container');
        const hiddenTimeInput = document.getElementById('appointment_time');

        if (!trainerId || !dateInput || !timeSlotsContainer || !hiddenTimeInput) {
            console.error("Required booking form elements are missing.");
            return;
        }

        flatpickr(dateInput, {
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
            minDate: "today",
            onChange: function(selectedDates, dateStr, instance) {
                updateAvailableTimes(dateStr);
            }
        });

        async function updateAvailableTimes(selectedDate) {
            hiddenTimeInput.value = ''; // Reset hidden input
            timeSlotsContainer.innerHTML = '<p class="text-gray-400 col-span-full">Loading...</p>';

            if (!selectedDate) {
                timeSlotsContainer.innerHTML = '<p class="text-gray-400 col-span-full">Please select a date to see available times.</p>';
                return;
            }

            try {
                const response = await fetch(`/appointments/available-times/${trainerId}/${selectedDate}`);
                if (!response.ok) throw new Error('Failed to load time slots.');

                const availableSlots = await response.json();
                timeSlotsContainer.innerHTML = ''; // Clear previous slots

                if (availableSlots.length === 0) {
                    timeSlotsContainer.innerHTML = '<p class="text-gray-400 col-span-full">No available time slots for this date.</p>';
                    return;
                }

                availableSlots.forEach(slot => {
                    const button = document.createElement('button');
                    button.type = 'button';
                    button.textContent = slot;
                    button.className = 'time-slot-btn bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition duration-300';
                    button.dataset.time = slot;

                    button.addEventListener('click', function() {
                        // Set hidden input value
                        hiddenTimeInput.value = this.dataset.time;

                        // Handle active state for styling
                        document.querySelectorAll('.time-slot-btn').forEach(btn => btn.classList.remove('bg-blue-500', 'hover:bg-blue-600'));
                        this.classList.add('bg-blue-500', 'hover:bg-blue-600');
                    });

                    timeSlotsContainer.appendChild(button);
                });

            } catch (error) {
                console.error('Error fetching available times:', error);
                timeSlotsContainer.innerHTML = '<p class="text-red-500 col-span-full">Could not load times. Please try again.</p>';
            }
        }

        const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        document.getElementById('time_zone').value = timezone;
    });
})();
</script>
<style>
    .time-slot-btn.bg-blue-500 {
        background-color: #3b82f6 !important;
    }
</style>
@endpush
