@extends('layouts.admin.app')

@section('title', $page_title)
@push('css')
@endpush
@section('content')
  <section class="content-header">
    <h1>Dashboard</h1>
  </section>

  <section class="content">
    <div class="row">
		<a href="{{ route('services.index') }}" style="pointer:cursor;">
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-blue"><i class="fa fa-code-fork"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Total Services</span>
						<span class="info-box-number">{{$total_category}}</span>
					</div>
				</div>
			</div>                         
		</a>
		 <a href="{{ route('trainer.index') }}" style="pointer:cursor;">
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-blue"><i class="fa fa-users"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Total Trainers</span>
						<span class="info-box-number">{{$total_trainer}}</span>
					</div>
				</div>
			</div>                         
		</a>
		<a href="{{ route('testimonial.index') }}" style="pointer:cursor;">
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-blue"><i class="fa fa-star"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Total Testimonials</span>
						<span class="info-box-number">{{$testimonials}}</span>
					</div>
				</div>
			</div>                         
		</a>
		<a href="{{ route('contactus.index') }}" style="pointer:cursor;">
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
				  <span class="info-box-icon bg-blue"><i class="fa fa-hand-o-right"></i></span>
				  <div class="info-box-content">
					<span class="info-box-text">Total Contact Us</span>
					<span class="info-box-number">{{$total_contactus}}</span>
				  </div>
				</div>
			</div>
		</a>
		{{--<a href="{{ route('projects.index') }}" style="pointer:cursor;">
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-blue"><i class="fa fa-check"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Project Approved</span>
						<span class="info-box-number">{{$total_projects_approved}}</span>
					</div>
				</div>
			</div>
		</a>
		<a href="{{ route('projects.index') }}" style="pointer:cursor;">
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-blue"><i class="fa fa-times"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Project Rejected</span>
						<span class="info-box-number">{{$total_projects_rejected}}</span>
					</div>
				</div>
			</div>
		</a>
		<a href="{{ route('member_directory.index') }}" style="pointer:cursor;">
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-blue"><i class="fa fa-hourglass-start"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Member Directory Pending</span>
						<span class="info-box-number">{{$total_member_directory_pending}}</span>
					</div>
				</div>
			</div>                         
		</a>
		<a href="{{ route('member_directory.index') }}" style="pointer:cursor;">
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-blue"><i class="fa fa-check"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Member Directory Approved</span>
						<span class="info-box-number">{{$total_member_directory_approved}}</span>
					</div>
				</div>
			</div>
		</a>
		<a href="{{ route('member_directory.index') }}" style="pointer:cursor;">
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-blue"><i class="fa fa-times"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Member Directory Rejected</span>
						<span class="info-box-number">{{$total_member_directory_rejected}}</span>
					</div>
				</div>
			</div>
		</a> --}}  
		{{-- 
		<!-- <a href="{{ route('newsletter.index') }}" style="pointer:cursor;">
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="info-box">
				  <span class="info-box-icon bg-blue"><i class="fa fa-newspaper-o"></i></span>
				  <div class="info-box-content">
					<span class="info-box-text">Our Newsletter</span>
					<span class="info-box-number">{{$total_subscriber}}</span>
				  </div>
				</div>
			</div>
		</a> -->--}}
        {{-- <a href="{{ route('appointment.index') }}" style="pointer:cursor;">
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="info-box">
				  <span class="info-box-icon bg-blue"><i class="fa fa-hand-o-right"></i></span>
				  <div class="info-box-content">
					<span class="info-box-text">Total Appointments</span>
					<span class="info-box-number">{{$total_appointments}}</span>
				  </div>
				</div>
			</div>
		</a> --}}
		{{-- <a href="{{ route('deals.index') }}" style="pointer:cursor;">
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="info-box">
				  <span class="info-box-icon bg-blue"><i class="fa fa-hand-o-right"></i></span>
				  <div class="info-box-content">
					<span class="info-box-text">Total Deals</span>
					<span class="info-box-number">{{$total_deals}}</span>
				  </div>
				</div>
			</div>
		</a> --}}
		{{-- <a href="{{ route('product.index') }}" style="pointer:cursor;">
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="info-box">
				  <span class="info-box-icon bg-blue"><i class="fa fa-hand-o-right"></i></span>
				  <div class="info-box-content">
					<span class="info-box-text">Total Products</span>
					<span class="info-box-number">{{$total_products}}</span>
				  </div>
				</div>
			</div>
		</a> --}}
    </div>
  </section>
@endsection
