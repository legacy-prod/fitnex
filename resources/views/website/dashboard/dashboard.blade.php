@extends('layouts.website.master')
@section('content')
    <!-- BANNER SEC -->
        <section class="banner">
            <div class="container">
                <div class="row">
                  <div class="col-md-3"></div>
                  <div class="col-md-6">
                    <div class="banner-heading">
                        <h1>MY ACCOUNT</h1>
                    </div>
                  </div>
                  <div class="col-md-3"></div>
                </div>
            </div>
        </section>
    <!-- BANNER SEC -->


    <div class="my-acc registration-page">
        <div class="container">
            <div id="post-38" class="post-39 page type-page status-publish hentry">
                <div class="row">
                    <div class="col-lg-3 col-md-12">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#dashboard" role="tab" aria-controls="v-pills-home" aria-selected="true">Dashboard</a>
                            <!-- <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#orders" role="tab" aria-controls="v-pills-profile" aria-selected="false">Orders</a> -->
                            <li>
                                <a class="nav-link" href="" id="v-pills-profile-tab" href="" role="tab" aria-controls="v-pills-profile" data-toggle="dropdown" aria-haspopup="true" aria-selected="false">
                                    My Bookings
                                </a>
                                <ul aria-expanded="false" class="dropdown-menu">
                                    <li><a href="#cars" class="nav-link" data-toggle="pill" id="v-pills-profile-tab" role="tab" aria-controls="v-pills-profile"><span class="dropdown-item"></span> Cars <span class="hide-menu"></span></a></li>
                                    <li><a href="#properties" class="nav-link" data-toggle="pill" id="v-pills-profile-tab" role="tab" aria-controls="v-pills-profile"><span class="dropdown-item"></span> Properties/House <span class="hide-menu"></span></a></li>
                                </ul>
                            </li>
                            <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#address" role="tab" aria-controls="v-pills-settings" aria-selected="false">Addresses</a>
                            <a class="nav-link" id="v-pills-account-details" data-toggle="pill" href="#account-details" role="tab" aria-controls="v-pills-settings" aria-selected="false">Account</a>
                            <div>
                                <a class="dropdown-item btn btn-default btn-flat" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="v-pills-home-tab">

                                <p>From your account dashboard you can view your <a href="">recent orders</a> , manage your <a href="">shipping and billing addresses</a> , and <a href="">edit your password and account details</a> .</p>
                            </div>
                            <div class="tab-pane fade" id="cars" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <table id="" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="30">SR#</th>
                                    <th>Booking Date/Time</th>
                                    <th>Pickup Date/Time</th>
                                    <th>Return Date/Time</th>
                                    <th>Total Amount </th>
                                    <th>Write A Review </th>
                                    {{-- <th>Car Type </th>
                                    <th>Car # </th> --}}
                                    <th>View Details </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="body">

                            </tbody>
                        </table>
                            </div>
                            <div class="tab-pane fade" id="properties" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <table id="" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="30">SR#</th>
                                    <th>Booking Date/Time</th>
                                    <th>Duration To Date</th>
                                    <th>Duration From Date</th>
                                    <th>Total Amount </th>
                                    <th>Write A Review </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="body">

                            </tbody>
                        </table>
                            </div>
                            <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                <p class="address-para">The following addresses will be used on the checkout page by default.</p>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="billing">
                                            <h2 class="addres">Billing address</h2>
                                            <a href="" class="add">Add</a>
                                          {{--   <a href="" class="edit">Edit</a> --}}
                                            <p class="details">admin admin <br> rcao <br> 12 ventnor street<br> hull<br> test <br>HU5 2LP<br> United Kingdom (UK)</p>
                                            <p class="details">You have not set up this type of address yet.</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="billing">
                                            <h2 class="addres">Shipping address</h2>
                                            <a href="" class="add">Add</a>
                                           {{--  <a href="" class="edit">Edit</a> --}}
                                            <p class="details">United Kingdom (UK)</p>
                                            <p class="details">You have not set up this type of address yet.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="account-details" role="account-details" aria-labelledby="account-details">
                                <div class="form">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            <label>First name <span style="color: red;">*</span></label> <br>
                                            <input type="text" class="form-for-us" id="text">
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <label>Last Name <span style="color: red;">*</span></label> <br>
                                            <input type="text" class="form-for-us" id="text">
                                        </div>
                                    </div>
                                    <label>Display name <span style="color: red;">*</span></label> <br>
                                    <input type="text" class="form-for-us" id="text">

                                    <label>Email address<span style="color: red;">*</span></label> <br>
                                    <input type="email" class="form-for-us" id="mail">


                                    <div class="password-group">
                                        <label>Current password (leave blank to leave unchanged)<span style="color: red;">*</span></label> <br>
                                        <input type="password" class="form-for-us password-box" aria-label="password" value="">
                                        <a href="#!" class="password-visibility"><i class="fa fa-eye"></i></a>
                                    </div>
                                    <div class="password-group">
                                        <label>New password (leave blank to leave unchanged)<span style="color: red;">*</span></label> <br>
                                        <input type="password" class="form-for-us password-box" aria-label="password" value="">
                                        <a href="#!" class="password-visibility"><i class="fa fa-eye"></i></a>
                                    </div>
                                    <div class="password-group">
                                        <label> Confirm new password<span style="color: red;">*</span></label> <br>
                                        <input type="password" class="form-for-us password-box" aria-label="password" value="">
                                        <a href="#!" class="password-visibility"><i class="fa fa-eye"></i></a>
                                    </div>
                                    <button type="submit" id="submit" class="submit">Log In</button>

                                </div>
                            </div>
                            <div class="tab-pane fade" id="logout" role="logout" aria-labelledby="logout">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(function() {
            $('.password-group').find('.password-box').each(function(index, input) {
                var $input = $(input);
                $input.parent().find('.password-visibility').click(function() {
                    var change = "";
                    if ($(this).find('i').hasClass('fa-eye')) {
                        $(this).find('i').removeClass('fa-eye')
                        $(this).find('i').addClass('fa-eye-slash')
                        change = "text";
                    } else {
                        $(this).find('i').removeClass('fa-eye-slash')
                        $(this).find('i').addClass('fa-eye')
                        change = "password";
                    }
                    var rep = $("<input type='" + change + "' />")
                        .attr('id', $input.attr('id'))
                        .attr('name', $input.attr('name'))
                        .attr('class', $input.attr('class'))
                        .val($input.val())
                        .insertBefore($input);
                    $input.remove();
                    $input = rep;
                }).insertAfter($input);
            });
        });
    </script>

@endsection
