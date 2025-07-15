@extends('layouts.website.master')
@section('content')
<link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" />
	<style>
		.date-picker.row {width: 100%;margin: 0;}
		.date-picker.row .ui.input{width: 100% !important;}
		.form-group.col-md-6 input[type="time"] {padding: 17px 5px;}
	</style>
  <!-- BANNER SEC -->
  <section class="banner-imnner-about">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="iner-baner-head">
                    <h1>BOOK A APPOINTMENT</h1>
                    <p class="extra-text">Home > Book A Appointment</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna alion.</p>
                </div>    
            </div>
        </div>
    </div>
</section>
<!-- BANNER SEC -->
    <!-- BOOK AN APPOINTMENT -->
    <section class="book-appointment">
        <div class="container">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="book-appointment-form my-5">
                        @if(session('success'))
                            <div class="alert alert-success">{{session('success')}}</div>
                        @endif
                        <form action="{{ route('save-appointment') }}" method="POST">
                            @csrf
                            
                            <div class="row">
								
                                <div class="form-group col-md-6">
                                    <label for="">Estimated Date of Appointment <span style="color: red">*</span></label>
									<div class="date-picker row">
										<div class="form-group col-md-12 ui calendar p-0" id="example3">
											<div class="ui input left icon">
												<i class="calendar icon"></i>
												<input type="text" autocomplete="off" id="sdatepicker" name="pickup_date" class="datepicker" placeholder="Date" required>
											</div>
										</div>
									</div>
								</div>
                                <div class="form-group col-md-6">
                                    <label for="time">Time <span style="color: red">*</span></label>
                                    <input type="time" class="form-control" name="pickup_time" autocomplete="off" id="datetimepicker111" value="{{ old('pickup_time') }}" data-date-format="HH:mm" placeholder="choose time">
                                    <span style="color: red">{{ $errors->first('pickup_time') }}</span>
								</div>
                            <!--</div>
							<div class="row">-->
								<div class="form-group col-md-12" style="padding-bottom:25px;">
									<label for="" class="control-label">Time Zone<span style="color: red">*</span></label>
									<div>
										<select name="time_zone" id="time_zone" class="form-control time_zone">
											<option value="" selected>Select Time Zone</option>
											@foreach ($cities as $city)
												<option value="{{ $city->id }}" {{ old('time_zone')==$city->id?'selected':'' }}>{{ $city->time_zone }}</option>
											@endforeach
										</select>
										<span style="color: red">{{ $errors->first('time_zone') }}</span>
									</div>
								</div>
							</div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="exampleFormControlTextarea3">Appointment Description <span style="color: red">*</span></label>
                                    <textarea name="description" class="form-control" id="exampleFormControlTextarea3" rows="7" placeholder="Write description here...">{{ old('description') }}</textarea>
                                    <span style="color: red">{{ $errors->first('description') }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <input type="submit" value="BOOK APPOINTMENT" class="book-appointment-btn">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- BOOK AN APPOINTMENT -->
<script src="https://code.jquery.com/jquery-3.6.0.js" crossorigin="anonymous"></script>
    <script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>
    <script>
		var today = new Date();
		$('#example3').calendar({
			type: 'date',
			minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() - -1),
		});
        $('#example1').calendar();
        $('#example2').calendar({
        type: 'date'
        });
        $('#example33').calendar({
        type: 'date'
        });
		
        $('#rangestart').calendar({
        type: 'date',
        endCalendar: $('#rangeend')
        });
        $('#rangeend').calendar({
        type: 'date',
        startCalendar: $('#rangestart')
        });
        $('#example4').calendar({
        startMode: 'year'
        });
        $('#example5').calendar();
        $('#example6').calendar({
        ampm: false,
        type: 'time'
        });
        $('#example7').calendar({
        type: 'month'
        });
        $('#example8').calendar({
        type: 'year'
        });
        $('#example9').calendar();
        $('#example10').calendar({
        on: 'hover'
        });
        var today = new Date();
        $('#example11').calendar({
			type: 'date',
        minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() - 5),
        maxDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() + 5)
        });
        $('#example12').calendar({
        monthFirst: false
        });
        $('#example13').calendar({
        monthFirst: false,
        formatter: {
            date: function (date, settings) {
            if (!date) return '';
            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getFullYear();
            return day + '/' + month + '/' + year;
            }
        }
        });
        $('#example14').calendar({
        inline: true
        });
        $('#example15').calendar();
    </script>
    @endsection
