@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')

<section class="content-header">
	<div class="content-header-left">
		<h1>{{ $page_title }}</h1>
	</div>
	<div class="content-header-right">
		<a href="{{ route('appointment.index') }}" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-info">
				<div class="box-body">
					<table id="" class="table table-bordered table-striped">
						<tbody id="body">
							<tr>
								<th colspan="2"><u><i class="fa fa-arrow-right"></i>Appointment Details</u></th>
							</tr>
							<tr>
								<th>EPC Developer Name</th>
								<td>{{ $appointment->hasCustomer->name }}</td>
							</tr>
							<tr>
								<th>Phone</th>
								<td>{{ $appointment->hasCustomer->phone??'--' }}</td>
							</tr>
							<tr>
								<th>Email</th>
								<td>{{ $appointment->hasCustomer->email }}</td>
							</tr>
							<!--<tr>-->
							<!--	<th>Address</th>-->
							<!--	<td>{{ $appointment->address??'--' }}</td>-->
							<!--</tr>-->
							<!--<tr>-->
							<!--    <th>City</th>-->
							<!--	<td>{{ $appointment->city??'--' }}</td>-->
							<!--</tr>-->
							<!--<tr>-->
							<!--	<th>State</th>-->
							<!--	<td>{{ $appointment->state??'--' }}</td>-->
							<!--</tr>-->
							<tr>
								<th>Appointment Date</th>
								<td>{{ date('d, F-Y', strtotime($appointment->pickup_date)) }}</td>
							</tr>
							<tr>
								<th>Appointment Time</th>
								<td>{{ date('h:i A', strtotime($appointment->pickup_time)) }}</td>
							</tr>
							<tr>
								<th>Description</th>
								<td>{{ $appointment->description??'--' }}</td>
							</tr>
							<tr>
								<th>Drop Time Zone</th>
								<td>{{ isset($appointment->hasTimeZone)?$appointment->hasTimeZone->time_zone:'--' }}</td>
							</tr>
							<tr>
								<th>Review</th>
								<td>{{ $appointment->review??'--'}}</td>
							</tr>
							<tr>
								<th>Comment</th>
								<td>{{ $appointment->comment??'--'}}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection