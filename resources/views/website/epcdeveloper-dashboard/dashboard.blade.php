@if (Auth::user()->hasRole('EPC Developer'))
    @extends('layouts.epc-developer.app')
@endif
@section('title', $page_title)
@section('content')
  <section class="content-header">
    <h1 style="color:#c98900 !important; font-weight: 700;">{{ Auth::user()->role}} Dashboard</h1>
  </section>
  <section class="content">
    <div class="row">
	
		<a href="{{ route('client_contact.index') }}" style="pointer:cursor;">
			<div class="col-md-4">
				<div class="info-box">
					<span class="info-box-icon bg-blue"><i class="fa fa-envelope" aria-hidden="true"></i></span>
					<div class="info-box-content">
						<span class="info-box-text"> Total Contact Me</span>
						<span class="info-box-number">{{$total_client_contact}}</span>
					</div>
				</div>
			</div>
		</a>
		<a href="{{ route('projects.index') }}" style="pointer:cursor;">
			<div class="col-md-4">
				<div class="info-box">
					<span class="info-box-icon bg-blue"><i class="fa fa-sitemap" aria-hidden="true"></i></span>
					<div class="info-box-content">
						<span class="info-box-text"> Total Projects</span>
						<span class="info-box-number">{{$total_projects}}</span>
					</div>
				</div>
			</div>
		</a>
		<a href="{{ route('member_directory.index') }}" style="pointer:cursor;">
			<div class="col-md-4">
				<div class="info-box">
					<span class="info-box-icon bg-blue"><i class="fa fa-users" aria-hidden="true"></i></span>
					<div class="info-box-content">
						<span class="info-box-text"> Total Member Directory</span>
						<span class="info-box-number">{{$total_member_directory}}</span>
					</div>
				</div>
			</div>
		</a>
    </div>
  </section>
@endsection
