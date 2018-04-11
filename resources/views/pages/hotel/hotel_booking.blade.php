@extends('layouts.app')

@section('page-title') Hotel Result  @endsection

@section('content')

    <!-- START: PAGE TITLE -->
    <div class="row page-title">
        <div class="container clear-padding text-center flight-title">
            <h3>YOUR SELECTION</h3>
            <h4>Grand Lilly</h4>
            <span><i class="fa fa-calendar"></i> Check In - 05 Aug <i class="fa fa-calendar"></i> Check Out - 05 Aug <i class="fa fa-male"></i> Guest(s) - 2 Adult</span>
        </div>
    </div>
    <!-- END: PAGE TITLE -->

    <!-- START: BOOKING TAB -->
    <div class="row booking-tab">
        <div class="container clear-padding">
            <ul class="nav nav-tabs">
                <li class="active col-md-offset-2 col-md-4 col-sm-offset-2 col-sm-4 col-xs-offset-2 col-xs-4"><a data-toggle="tab" href="#review-booking" class="text-center"><i class="fa fa-edit"></i> <span>Review Booking</span></a></li>
                <li class="col-md-4 col-sm-4 col-xs-4"><a data-toggle="tab" href="#passenger-info" class="text-center"><i class="fa fa-male"></i> <span>Passenger Info</span></a></li>
            </ul>
        </div>
    </div>
    <div class="row booking-detail">
        <div class="container clear-padding">
            <div class="tab-content">
                <div id="review-booking" class="tab-pane fade in active">
                    <div class="col-md-8 col-sm-8">
                        <div class="booking-summary-v2">
                            <div class="col-md-4 col-sm-6 clear-padding">
                                <img src="assets/images/offer1.jpg" alt="cruise">
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <h4>Grand Lilly <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></h4>
                                <div class="col-md-6 col-sm-6 col-xs-6 clear-padding">
                                    <p>Check In</p>
                                    <p><i class="fa fa-calendar"></i> SAT, 22 AUG</p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6 clear-padding">
                                    <p>Check Out</p>
                                    <p><i class="fa fa-calendar"></i> SAT, 22 AUG</p>
                                </div>
                                <div class="clearfix"></div>
                                <p><span>Guest(s)</span> - 2 Adult</p>
                                <p><span>Room Type</span> - Deluxe Suite</p>
                            </div>
                            <div class="clearfix visible-sm-block"></div>
                            <div class="col-md-2 text-center">
                                <a href="#">CHANGE</a>
                            </div>
                        </div>
                        <div class="login-box">
                            <h3>Sign In</h3>
                            <div class="booking-form">
                                <div class="col-md-6 col-sm-6">
                                    <form >
                                        <label>Email</label>
                                        <input class="form-control" type="email" name="emailid" placeholder="Enter Your Email" required>
                                        <label>Password</label>
                                        <input class="form-control" type="password" name="password" placeholder="Enter Password" required>
                                        <a href="#">Forget Password?</a>
                                        <label>Phone Number (Optional)</label>
                                        <input class="form-control" type="text" name="phone">
                                        <label><input type="checkbox" name="remember"> Remember me</label>
                                        <button type="submit">Login</button>
                                    </form>
                                </div>
                                <div class="col-md-6 col-sm-6 text-center">
                                    <div class="social-media-login">
                                        <a href="#"><i class="fa fa-facebook"></i>Log in With Facebook</a>
                                        <span>Or</span>
                                        <a href="#"><i class="fa fa-plus"></i>Create Account</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 booking-sidebar">
                        <div class="sidebar-item">
                            <h4><i class="fa fa-bookmark"></i>Price Details</h4>
                            <div class="sidebar-body">
                                <table class="table">
                                    <tr>
                                        <td>Adult 1</td>
                                        <td>$199</td>
                                    </tr>
                                    <tr>
                                        <td>Base Ammount</td>
                                        <td>$100</td>
                                    </tr>
                                    <tr>
                                        <td>Service Tax</td>
                                        <td>$50</td>
                                    </tr>
                                    <tr>
                                        <td>Other Taxes</td>
                                        <td>$20</td>
                                    </tr>
                                    <tr>
                                        <td>You Pay</td>
                                        <td class="total">$500</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="sidebar-item contact-box">
                            <h4><i class="fa fa-phone"></i>Need Help?</h4>
                            <div class="sidebar-body text-center">
                                <p>Need Help? Call us or drop a message. Our agents will be in touch shortly.</p>
                                <h2>+91 1234567890</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="passenger-info" class="tab-pane fade">
                    <div class="col-md-8 col-sm-8">
                        <div class="passenger-detail">
                            <h3>Guest Details</h3>
                            <div class="passenger-detail-body">
                                <form >
                                    <div class="col-md-6 ol-sm-6">
                                        <label>First Name</label>
                                        <input type="text" name="firstname" required class="form-control">
                                    </div>
                                    <div class="col-md-6 ol-sm-6">
                                        <label>Last Name</label>
                                        <input type="text" name="lastname" required class="form-control">
                                    </div>
                                    <div class="col-md-6 ol-sm-6">
                                        <label>Email</label>
                                        <input type="email" name="email" required class="form-control">
                                    </div>
                                    <div class="col-md-6 ol-sm-6">
                                        <label>Verify Email</label>
                                        <input type="email" name="verify_email" class="form-control">
                                    </div>
                                    <div class="col-md-6 ol-sm-6">
                                        <label>Country Code</label>
                                        <select name="countrycode" class="form-control">
                                            <option>+1 United States</option>
                                            <option>+1 Canada</option>
                                            <option>+44 United Kingdom</option>
                                            <option>+91 India</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 ol-sm-6">
                                        <label>Phone Number</label>
                                        <input type="text" name="phonenumber" class="form-control" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label><input type="checkbox" name="alert"> Send me newsletters and updates</label>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit">CONTINUE <i class="fa fa-chevron-right"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 booking-sidebar">
                        <div class="sidebar-item">
                            <h4><i class="fa fa-phone"></i>Need Help?</h4>
                            <div class="sidebar-body text-center">
                                <p>Need Help? Call us or drop a message. Our agents will be in touch shortly.</p>
                                <h2>+91 1234567890</h2>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END: BOOKING TAB -->

@endsection

@section('javascript')
@endsection

@section('css')

@endsection