@extends('layouts.user.app')
@section('title', $page_title)
@section('content')
{{-- <style>
	a.btn-for {
    background: #fccc24;
    border: 1px solid #fccc24;
    width: 100%;
    border-radius: 5px;
    font-weight: 600;
	text-decoration: none !important;
    color: #000 !important;
    padding: 4px 18px;
	}
	.cross {
	padding: 10px;
    color: #d6312d;
    cursor: pointer;
	font-size: 23px;
 	}
	.cross i{

		margin-top: -5px;
		cursor: pointer;
	}
	.models{
	height: 100%;
	}
	.models{
		display: grid;
		place-items: center;
		font-family: 'Manrope', sans-serif;
		background: #000;
	}
	.rate {
    float: left;
    height: 46px;
    padding: 0 10px;
	margin-top: -10px;
}
.rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: #ffc700;
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}
</style> --}}
<section class="content-header">
	<div class="content-header-left">
		<h1>{{ $page_title }}</h1>
	</div>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<table class="table my-tables  table-bordered  table-responsive text-nowrap">
				<thead>
					<tr>
						<th scope="col">Booking Number</th>
						<th scope="col">Trip Start Date</th>
						<th scope="col">Trip End Date</th>
						<th scope="col">Per Day Price</th>
						<th scope="col">Total Payment</th>
						<th scope="col">Payment Status</th>
						<th scope="col">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($bookings_details as $bookings_detail)
					<tr>
						<th scope="row">{{ $bookings_detail->booking_number }}</th>
						<td>{{ $bookings_detail->trip_start_date }} </td>
						<td>{{ $bookings_detail->trip_end_date }} </td>
						<td>{{ $bookings_detail->per_day_price }} </td>
						<td>{{ $bookings_detail->total_payment }}</td>
						<td>{{ $bookings_detail->payment_status }}</td>
						<td>
						<a href="{{ route('detail_show', $bookings_detail->booking_number) }}" class="btn-for"><i class="fa fa-eye"></i> VIEW</a>
						@if($bookings_detail->payment_status == 'paid' && $bookings_detail->review == '')
						<a href="" class="btn-for" booking_number="{{$bookings_detail->booking_number}}" id="reviewss"  data-toggle="modal" data-target="#form"><i class="fa fa-comments" aria-hidden="true"></i> REVIEW</a>
						@endif
						@if($bookings_detail->payment_status == 'unpaid')
						<a href="{{route('stripe.checkout' , $bookings_detail->id)}}" data-toggle="tooltip" data-placement="top" title="Edit faq" class="btn-for"><i class="fa fa-shopping-cart" aria-hidden="true"></i> CHECKOUT</a>
						@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</section>
<!-- Review Model -->
<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" id="models" role="document" style="width:40% !important;">
		<div class="modal-content">
			<div class="text-right cross" data-dismiss="modal"> <i class="fa fa-times mr-2"></i> </div>
			<div class="card-body text-center" style="padding:30px 20px;"> <img src=" https://i.imgur.com/d2dKtI7.png" height="100" width="100">
				<form action="{{ route('review.status') }}" method="post">
					@csrf
					<input type="hidden" name="bookings" id="bookings" class="booking" value="">
					<div class="row" style="margin-bottom: 25px;">
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Add Rating <span style='color:red'>*</span></label>
							<div class="col-sm-8">
								<div class="rate">
									<input type="radio" id="star5" name="review" value="5" />
									<label for="star5" title="text">5 stars</label>
									<input type="radio" id="star4" name="review" value="4" />
									<label for="star4" title="text">4 stars</label>
									<input type="radio" id="star3" name="review" value="3" />
									<label for="star3" title="text">3 stars</label>
									<input type="radio" id="star2" name="review" value="2" />
									<label for="star2" title="text">2 stars</label>
									<input type="radio" id="star1" name="review" value="1" />
									<label for="star1" title="text">1 star</label>
								</div>
							</div>
						</div>
					</div>
					<div class="comment-box text-center">
						<div class="row">
							<div class="form-group">
								<label for="" class="col-sm-3 control-label">Add Comment<span style='color:red'>*</span></label>
								<div class="col-sm-8">
									<textarea class="form-control" name="comment" placeholder="what is your review?" rows="4"></textarea>
								</div>
							</div>
						</div>
					</div>
					<button class="btn btn-success send px-5 text-center"  style="margin-top:10px;" type="submit">Send message <i class="fa fa-long-arrow-right ml-1"></i></button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@push('js')
<script>
$(document).on('click' , '#reviewss' , function(){
	var booking_number= $(this).attr('booking_number');
	$('#bookings').val(booking_number);
});
</script>
@endpush
