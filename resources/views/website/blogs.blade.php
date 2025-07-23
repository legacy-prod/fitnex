@extends('layouts.website.master')
@section('title', $page_title)
@section('content')
    
<style>
    .primary-theme-text {
        color: #00A3FF !important; /* Your primary theme color */
    }
</style>

<!-- Banner Section -->
<section class="inner-banner listing-banner" style="background: url('{{ ($banner && $banner->image) ? asset('/admin/assets/images/banner/'.$banner->image) : asset('/admin/assets/images/images.png') }}') no-repeat center/cover">
    <div class="container">
        <h1 class="relative mx-auto text-[50px] text-white font-bold leading-[1.1]" data-aos="flip-right" data-aos-easing="linear" data-aos-duration="1500">
            @php
                $title = ($banner && $banner->name) ? $banner->name : '';
                $parts = explode(' ', $title, 2);
            @endphp
            <span class="italic uppercase font-black">
                <span class="primary-theme-text">{{ $parts[0] }}</span>@if(isset($parts[1])) {{ $parts[1] }}@endif
            </span>
        </h1>
    </div>
</section>
<!-- Contact Us Section -->
    <section class="event-sec pt-100" id="sec-1">
        <div class="container">
            <h2 class="hd-70 heading text-primary-theme mb-20 text-center mb-100" data-aos="flip-left"
                data-aos-easing="linear" data-aos-duration="1500">Join us at an <span>FITNEX event!</span>
            </h2>

            <div class="row row-gap-60">
                <div class="col-lg-4" data-aos="fade-right" data-aos-easing="linear" data-aos-duration="1500">
                    <div class="img-wrapper md-shape theme-blue">
                        <img src="{{ asset('/assets/website') }}/images/events-01.png" class=""
                            alt="Events fitnex">
                    </div>
                </div>
                <div class="col-lg-8" data-aos="fade-left" data-aos-easing="linear" data-aos-duration="1500">
                    <div class="img-wrapper md-shape">
                        <img src="{{ asset('/assets/website') }}/images/events-02.png" class=""
                            alt="Events fitnex">
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-right" data-aos-easing="linear" data-aos-duration="1500">
                    <div class="img-wrapper md-shape">
                        <img src="{{ asset('/assets/website') }}/images/events-03.png" class=""
                            alt="Events fitnex">
                    </div>
                </div>
                <div class="col-lg-8" data-aos="fade-left" data-aos-easing="linear" data-aos-duration="1500">
                    <div class="img-wrapper md-shape theme-blue">
                        <img src="{{ asset('/assets/website') }}/images/events-04.png" class=""
                            alt="Events fitnex">
                    </div>
                </div>
            </div>
    </section>
    <section class="registration-sec pt-100">
        <div class="container">
            <h2 class="hd-70 heading text-primary-theme mb-20 text-center" data-aos="flip-left" data-aos-easing="linear" data-aos-duration="1500">Upcoming:</h2>
            <div class="row justify-content-center">
                @foreach($events as $event)
                    <div class="col-lg-8" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1500">
                        <div class="card-lg text-center p-4 mb-4">
                            <h3 class="hd-20 text-primary-theme mb-3">{{ $event['title'] }}</h3>
                            <p class="mb-1 text-white">{{ $event['host'] }}</p>
                            <p class="mb-1 text-white">{{ \Carbon\Carbon::parse($event['date'])->format('l, F d, Y') }}</p>
                            <p class="mb-1 text-white">
                                {{
                                    str_replace(['am', 'pm'], ['a.m.', 'p.m.'],
                                        \Carbon\Carbon::parse($event['time'])->format('g:i a')
                                    )
                                }}
                                until
                                {{
                                    str_replace(['am', 'pm'], ['a.m.', 'p.m.'],
                                        \Carbon\Carbon::parse($event['end_time'])->format('g:i a')
                                    )
                                }}
                            </p>
                            <p class="mb-3 text-white">
                                @if(!empty($event['location_link']))
                                    <a href="{{ $event['location_link'] }}" target="_blank" class="text-white" style="text-decoration: underline;">
                                        {{ $event['location'] }}
                                    </a>
                                @else
                                    {{ $event['location'] }}
                                @endif
                            </p>
                            <a href="{{ $event['registration_link'] }}" target="_blank" class="btn btn-primary pack mx-auto d-flex justify-content-center text-capitalize w-100" style="font-size: 1.5rem; max-width: 300px;">REGISTER HERE</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
