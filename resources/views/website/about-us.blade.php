@extends('layouts.website.master')
@section('title', $page_title)
@section('content')

<style>
    .primary-theme-bg {
        background-color: #00A3FF; /* Your primary theme color */
    }
    .primary-theme-text {
        color: #00A3FF; /* Your primary theme color */
    }
    .section-padding {
        padding: 80px 0;
    }
    .section-heading {
        font-size: 3rem;
        font-weight: bold;
        text-transform: uppercase;
        margin-bottom: 1rem;
    }
    .section-subheading {
        font-size: 1.25rem;
        max-width: 600px;
        margin: 0 auto 3rem auto;
        color: #e0e0e0;
    }
    .content-text {
        color: #d1d1d1;
        line-height: 1.8;
    }
    .mission-list li {
        position: relative;
        padding-left: 25px;
        margin-bottom: 15px;
    }
    .mission-list li::before {
        content: '\2713';
        position: absolute;
        left: 0;
        top: 0;
        color: #00A3FF; /* Your primary theme color */
        font-weight: bold;
    }
</style>

<!-- Banner Section -->
<section class="inner-banner listing-banner" style="background: url('{{ ($banner && $banner->image) ? asset('/admin/assets/images/banner/'.$banner->image) : asset('/admin/assets/images/images.png') }}') no-repeat center/cover; background-attachment: fixed;">
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

<!-- Who We Are Section -->
<section class="who-we-are-section bg-black section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000">
                @if(isset($page_data['about_us_image']))
                <div class="img-wrapper rounded-lg overflow-hidden">
                    <img src="{{ asset('/admin/assets/images/page/' . $page_data['about_us_image']) }}" class="w-100" alt="Who We Are">
                </div>
                @endif
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-duration="1000">
                <h2 class="section-heading text-white">Who <span class="primary-theme-text">We</span> Are</h2>
                @if(isset($page_data['about_description']))
                    <p class="content-text mb-4">{{ $page_data['about_description'] }}</p>
                @endif
                @if(isset($page_data['about_description_two']))
                    <p class="content-text">{{ $page_data['about_description_two'] }}</p>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Our Mission Section -->
<section class="our-mission-section bg-gray-900 section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 order-lg-2" data-aos="fade-left" data-aos-duration="1000">
                @if(isset($page_data['why_image']))
                <div class="img-wrapper rounded-lg overflow-hidden">
                    <img src="{{ asset('/admin/assets/images/page/' . $page_data['why_image']) }}" class="w-100" alt="Our Mission">
                </div>
                @endif
            </div>
            <div class="col-lg-6 order-lg-1" data-aos="fade-right" data-aos-duration="1000">
                <h2 class="section-heading text-white">Our <span class="primary-theme-text">Mission</span></h2>
                @if(isset($page_data['our_mission_description']))
                    <p class="content-text mb-4">{{ $page_data['our_mission_description'] }}</p>
                @endif
                <ul class="mission-list list-unstyled">
                    @if(isset($page_data['first_our_mission_description']))
                        <li class="content-text">{{ $page_data['first_our_mission_description'] }}</li>
                    @endif
                    @if(isset($page_data['second_our_mission_description']))
                        <li class="content-text">{{ $page_data['second_our_mission_description'] }}</li>
                    @endif
                    @if(isset($page_data['third_our_mission_description']))
                        <li class="content-text">{{ $page_data['third_our_mission_description'] }}</li>
                    @endif
                    @if(isset($page_data['fourth_our_mission_description']))
                        <li class="content-text">{{ $page_data['fourth_our_mission_description'] }}</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</section>

@endsection
