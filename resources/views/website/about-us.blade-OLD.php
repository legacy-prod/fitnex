@extends('layouts.website.master')
@section('title', $page_title)
@section('content')
@if(!empty($banner->image))
<section class="inner-banner about-banner" style="background-image: url('{{asset('/admin/assets/images/banner') }}/{{ $banner->image }}');"> 
@else
<section class="inner-banner about-banner" style="background-image: url('{{asset('/admin/assets/images/images.png') }}');" style="width:100%">
@endif
  <div class="banner-wrapper position-relative z-1">
    <div class="container">
      <div class="row">
        @include('website.include.social-links') 
        <div class="col-lg-6 col-xl-5" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1500">
          <div class="card">
            <div class="shape-1"></div>
              @if(isset($banner))
                <h1 class="hd-70">{{$banner->name}}</h1> 
              @endif
          </div>
        </div>
      </div>
      <a href="#sec-1" class="">
        <div class="top-to-bottom">
          <i class="fa-solid fa-arrow-down"></i>
        </div>
      </a>
    </div>
  </div>
</section>
<section class="who-we-are py-70" id="sec-1">
  <div class="container">
    <div class="row row-gap-40 align-items-center">
      <div class="col-lg-6" data-aos="fade-right"
        data-aos-easing="linear"
        data-aos-duration="1500">
        <h2 class="text-uppercase hd-42 heading mb-20">who <span>we are</span>?</h2>
        <h5 class="hd-20 mb-20 text-capitalize">
          {!! $home_page_data['about_description'] !!} 
        </h5>
        <p class="hd-20 fw-medium text-capitalize">
          {!! $home_page_data['about_description_two'] !!} 
        </p>
      </div>
      <div class="col-lg-6" data-aos="fade-left"
      data-aos-easing="linear"
      data-aos-duration="1500">
      <div class="img-wrapper md-shape">
        <img src="{{ asset('/admin/assets/images/page/'.$home_page_data['about_us_image']) }}" class="" alt="">
        </div>
      </div>
    </div>
  </div>
</section>


@endsection