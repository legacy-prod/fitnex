<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/assets/website/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/website/css/slickfirst.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <!-- LINK FOR DATE PICKER -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

    <title>SCVBA</title>
   <style>
	.info-invoice span {
		padding: 0 2px !important;
	}

	.main-heading h1 {
		font-size: 50px !important;
		font-weight: 700 !important;
		color: #f4cc21 !important;
	}

	.bill-para span {
		display: flex !important;
		padding: 7px 0 !important;
	}

	.bill-para2 {
		padding: 7px 0 !important;
		display: flex !important;
		justify-content: space-between !important;
	}

	.bill h3 {
		color: #fccc24 !important;
		font-size: 25px !important;
		font-weight: 600 !important;
	}

	.bill-para span {
		font-weight: 600 !important;
	}

	.bill-para2 span {
		font-weight: 600 !important;
	}

	.bill-para2 div {
		font-weight: 600 !important;
	}

	.vehical-info span {
		display: flex !important;
		padding: 8px 0 !important;
		font-weight: 600 !important;
	}

	.row.invoice-2 {
		padding: 40px 0 !important;
	}

	.row.invoice-3 {
		padding-bottom: 40px !important;
	}

	.info-table .table thead tr {
		background-color: #f4cc21 !important;
	}

	.info-table .table tbody {
		background-color: #d7d7d740 !important;
	}

	.main-div {
		max-width: 86% !important;
		display: block !important;
		margin: 0 auto !important;
		padding: 20px 50px !important;
		background-color: #f8f9fa !important;
	}

	.info-table .table th {
		border-top: none !important;
	}

	.info-table .table td {
		border-top: none !important;
	}

	.table-last {
		background-color: #f8f9fa !important;
		display: flex !important;
		justify-content: space-between !important;
		padding: 4px 0 19px 14px !important;
	}

	.table-last span, div {
		font-weight: 600 !important;
	}

	.table-total {
		background-color: #f4cc21 !important;
		display: flex !important;
		justify-content: space-between !important;
		padding: 11px 14px !important;
	}

	.table-total span, div {
		font-weight: 600 !important;
	}
	body{
            position:relative;
            background-color:#f8f9fa;
            font-family: 'Helvetica';
        }
        .for-right{
            position:absolute;
            right:50px;
            top:20px;
        }
        .row.invoice-3{
            position:relative;
        }
        .for-left-veh{
            position:absolute;
            left:0;
            top:0;
        }
        .for-right-veh{
            position:absolute;
            right:0;
            top:0;
        }
        .row.invoice-4{
            position:absolute;
            top:45%;
        }
        .row.last-table-row{
            position:relative;
        }
        .for-last-col6{
            position:absolute;
            right:0;
            top:0;
        }
        .table-total{
            position:relative;
            height:24px;
        }
        .for-payment-left{
            position:absolute;
            left:5px;
            top:12px;
        }
        .for-payment-right{
            position:absolute;
            right:5px;
            top:12px;
        }
   </style>
</head>
<body>
    <!-- INVOICE HTML  -->
    <section class="invoice">
        <div class="container">
            <div class="main-div">
                <div class="row invoice-1">
                    <div class="col-md-8">
                        <div class="invoice-img">
                            <img src="{{ asset('/assets/website/images/chef-logo.png') }}" alt="">
                        </div>
                    </div>
                    <div class="col-md-4 for-right">
                        <div class="main-heading">
                            <h1>INVOICE</h1>
                        </div>
                        <div class="info-invoice">
                            <span>Booking Number:</span>
                            <span>{{$booking_details->booking_number}}</span>
                        </div>
                        <div class="info-invoice">
                            <span>Invoice Date:</span>
                            <span>{{date('d-m-Y')}}</span>
                        </div>
                    </div>
                </div>   
                <div class="row invoice-2">
                    <div class="col-md-5">
                        <div class="bill">
                            <h3>Bill To</h3>
                        </div>
                        <div class="bill-para">
                            <span>City:{{$booking_details->hasLocation->hasPickCity->city}} To {{$booking_details->hasLocation->hasDropCity->city}} </span>
                            <span>State:{{$booking_details->hasLocation->hasPickStates->state}} To {{$booking_details->hasLocation->hasDropStates->state}}</span>
                            <span>Address:{{$booking_details->hasLocation->pickup_address}} To {{$booking_details->hasLocation->drop_address}}</span>
                        </div>
                    </div>
                    
                </div> 
                <div class="bill">
                    <h3>Vehical information</h3>
                </div>
                <div class="row invoice-3">
                    <div class="col-md-3 for-left-veh">
                        <div class="vehical-info">
                            <span>Trip Start Date</span>
                            <span>{{ date('d-F-y', strtotime($booking_details->trip_start_date)) }}</span>
                        </div>
                    </div>
                    <div class="col-md-3 for-right-veh">
                        <div class="vehical-info">
                            <span>Trip End Date</span>
                            <span>{{ date('d-F-y', strtotime($booking_details->trip_end_date)) }}</span>
                        </div>
                    </div>
                </div>
                <div class="row invoice-4">
                    <div class="col-md-12">
                        <div class="info-table">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>S NO</th>
                                    <th>Product Name</th>
                                    <th>Price Per Day</th>
                                    <th>Total Days</th>
                                    <th>Total Payment</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>{{$booking_details->product_slug}}</td>
                                    <td>${{$booking_details->per_day_price}}</td>
                                    <td>{{$booking_details->total_days}}</td>
                                    <td>${{$booking_details->total_payment}}</td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="row last-table-row">
                                <div class="col-md-6"></div>
                                <div class="col-md-6 for-last-col6">
                                    <div class="table-total">
                                        <span class="for-payment-left">Total Payment</span>
                                        <div class="for-payment-right">${{$booking_details->total_payment}}</div>
                                    </div>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- INVOICE HTML  -->
    <!-- ALL JS -->
   
    <script src="assets/js/slick.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- FOR TABS MAIN -->
</body>
</html>