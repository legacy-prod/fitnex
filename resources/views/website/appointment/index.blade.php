@extends('layouts.website.master')
@section('title', $page_title)

@section('content')
<section class="inner-banner" style="background: url('{{ asset('/assets/website/images/trainer-banner.webp') }}') no-repeat center/cover;">
    <div class="container">
        <h1 class="relative text-white uppercase font-black text-[50px] leading-[1.1] lg:max-w-[680px] xxl:max-w-[860px]">
            {{ $page_title }}
        </h1>
    </div>
</section>

<section class="py-16 bg-black text-white">
    <div class="container">
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-gray-900 shadow-lg rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-800">
                        <tr>
                            <th class="p-4 font-semibold">Trainer</th>
                            <th class="p-4 font-semibold">Date & Time</th>
                            <th class="p-4 font-semibold">Price</th>
                            <th class="p-4 font-semibold">Status</th>
                            <th class="p-4 font-semibold">Payment</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse($models as $appointment)
                            <tr>
                                <td class="p-4 flex items-center space-x-3">
                                    <img src="{{ asset('admin/assets/images/Trainers/'.$appointment->trainer->image) }}" alt="{{ $appointment->trainer->name }}" class="w-12 h-12 rounded-full object-cover">
                                    <span>{{ $appointment->trainer->name }}</span>
                                </td>
                                <td class="p-4">
                                    {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y') }} at {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                                    <span class="text-sm text-gray-400 block">{{ $appointment->time_zone }}</span>
                                </td>
                                <td class="p-4">${{ number_format($appointment->price, 2) }}</td>
                                <td class="p-4">
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full
                                        @if($appointment->status == 'confirmed') bg-green-500 text-white
                                        @elseif($appointment->status == 'pending') bg-yellow-500 text-black
                                        @elseif($appointment->status == 'completed') bg-blue-500 text-white
                                        @else bg-red-500 text-white @endif">
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full
                                        @if($appointment->payment_status == 'completed') bg-green-500 text-white
                                        @else bg-yellow-500 text-black @endif">
                                        {{ ucfirst($appointment->payment_status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-6 text-center text-gray-400">You have no appointments.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 bg-gray-800">
                {{ $models->links() }}
            </div>
        </div>
    </div>
</section>
@endsection
