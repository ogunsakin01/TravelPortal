@extends('layouts.app')

@section('page-title') Hotel Result  @endsection

@section('content')

    <!-- START: PAGE TITLE -->
    <div class="row page-title">
        <div class="container clear-padding text-center flight-title">
            <h3>{{strtoupper($hotelInformation['hotelName'])}}</h3>
            <h5>
                @for($i = 0; $i < $hotelInformation['hotelStarRating']; $i++)
                    <i class="fa fa-star"></i>
                @endfor
                @for($i = 0; $i < (5-$hotelInformation['hotelStarRating']); $i++)
                    <i class="fa fa-star-o"></i>
                @endfor
            </h5>
            <p><i class="fa fa-map-marker"></i> {{$hotelInformation['hotelAddress']}}</p>
        </div>
    </div>
    <!-- END: PAGE TITLE -->

    <!-- START: BOOKING TAB -->
    <div class="row booking-tab">
        <div class="container clear-padding">
            <ul class="nav nav-tabs">
                <li class="active col-md-offset-4 col-md-4 col-sm-offset-4 col-sm-4 col-xs-offset-4 col-xs-4"><a data-toggle="tab" href="#review-booking" class="text-center"><i class="fa fa-edit"></i> <span>Review Booking</span></a></li>
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
                                @if(!is_array($hotelInformation['hotelImage']))
                                    <img src="{{$hotelInformation['hotelImage']}}" alt="{{$hotelInformation['hotelName']}}">
                                @else
                                    <img src="{{\App\Services\AmadeusConfig::cityImage($hotelInformation['hotelCityCode'])}}" alt="{{$hotelInformation['hotelName']}}">
                                @endif
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <h4>{{$hotelInformation['hotelName']}} <br/>
                                    @for($i = 0; $i < $hotelInformation['hotelStarRating']; $i++)
                                        <i class="fa fa-star"></i>
                                    @endfor
                                    @for($i = 0; $i < (5-$hotelInformation['hotelStarRating']); $i++)
                                        <i class="fa fa-star-o"></i>
                                    @endfor
                                </h4>
                                <div class="col-md-6 col-sm-6 col-xs-6 clear-padding">
                                    <p>Check In</p>
                                    <p><i class="fa fa-calendar"></i> {{date('D, d M',strtotime($searchParam['check_in_date']))}}</p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6 clear-padding">
                                    <p>Check Out</p>
                                    <p><i class="fa fa-calendar"></i> {{date('D, d M',strtotime($searchParam['check_out_date']))}}</p>
                                </div>
                                <div class="clearfix"></div>
                                <p><span>Guest(s)</span> - {{$searchParam['adult_count']}} Adult(s),{{$searchParam['child_count']}} Child(s)</p>
                                <p><span>Room Type</span> - {{$selectedRoom['roomDescription']}}</p>
                            </div>
                            <div class="clearfix visible-sm-block"></div>
                        </div>
                        @if(auth()->guest())
                            <div class="login-box">
                                <h3>Existing customer  ?  <button class="btn btn_travel_portal btn-sm pull-right sign-in">Sign in <i class="fa fa-sign-in"></i></button></h3>
                                <div class="booking-form sign-in-container hidden">
                                    <h4>Sign In</h4>
                                    <form >
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input class="form-control login_email" type="email" name="email" placeholder="Enter Your Email" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input class="form-control login_password" type="password" name="password" placeholder="Enter Password" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group" style="text-align: center">
                                                    <label></label>
                                                    <button class="login sign-in-submit">Sign In</button>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <a href="{{url('/password/reset')}}">Forget Password ?</a>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <a href="{{url('/register')}}">Not a registered customer ? Register here.</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="booking-form sign-up-container">
                                    <h4>Sign Up</h4>
                                    <div class="col-md-12">
                                        <form >
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Title</label>
                                                        <select name="title_id" class="selectpicker"  required>
                                                            @foreach($titles as $t => $title)
                                                            <option value="{{$title->id}}">{{$title->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="col-md-10">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Surname</label>
                                                            <div class="input-group">
                                                                <input name="sur_name" type="text" class="form-control sur_name" placeholder="Surname (Family name)" required>
                                                                <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>First name</label>
                                                            <div class="input-group">
                                                                <input name="first_name" type="text" class="form-control first_name" placeholder="First name (Your name)" required>
                                                                <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Other name</label>
                                                            <div class="input-group">
                                                                <input name="other_name" type="text" class="form-control other_name" placeholder="Other name (Your other name)" required>
                                                                <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Email</label>
                                                    <div class="input-group">
                                                        <input name="email" type="email" class="form-control register_email" placeholder="Email" required>
                                                        <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Phone</label>
                                                    <div class="input-group">
                                                        <input name="phone" type="tel" class="form-control register_phone" placeholder="Phone number" required>
                                                        <span class="input-group-addon"><i class="fa fa-phone fa-fw"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Password</label>
                                                    <div class="input-group">
                                                        <input id="password" type="password" class="form-control password" name="password" placeholder="Password" required>
                                                        <span class="input-group-addon"><i class="fa fa-eye fa-fw"></i></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Confirm Password</label>
                                                    <div class="input-group">
                                                        <input id="password-confirm" type="password" class="form-control password_confirmation" name="password_confirmation" placeholder="Retype Password">
                                                        <span class="input-group-addon"><i class="fa fa-eye fa-fw"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button class="btn btn_travel_portal sign-up-submit"> Sign Up</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <br/>
                        @endif
                        <br/>
                        <div class="passenger-detail @if(auth()->guest()) hidden @endif">
                            <h3>Customer Details</h3>
                            <div class="passenger-detail-body booking-form">
                                <form method="post" action="{{url('/hold-customer-hotel-booking-information')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><input type="checkbox" name="use_logged_in_user"> Use logged in customer details</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label> Title </label>
                                                <select name="title_id" class="form-control booking_title_id"  required>
                                                    @foreach($titles as $t => $title)
                                                        <option value="{{$title->id}}">{{$title->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Surname</label>
                                                    <div class="input-group">
                                                        <input name="sur_name" type="text" class="form-control booking_sur_name" placeholder="Surname (Family name)" required>
                                                        <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>First name</label>
                                                    <div class="input-group">
                                                        <input name="first_name" type="text" class="form-control booking_first_name" placeholder="First name (Your name)" required>
                                                        <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Other name</label>
                                                    <div class="input-group">
                                                        <input name="other_name" type="text" class="form-control booking_other_name" placeholder="Other name (Your other name)" required>
                                                        <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Email</label>
                                            <div class="input-group">
                                                <input name="email" type="email" class="form-control booking_email" placeholder="Email" required>
                                                <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Phone</label>
                                            <div class="input-group">
                                                <input name="phone" type="tel" class="form-control booking_phone" placeholder="Phone number" required>
                                                <span class="input-group-addon"><i class="fa fa-phone fa-fw"></i></span>
                                            </div>
                                        </div>
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
                            <h4><i class="fa fa-bookmark"></i>Price Details</h4>
                            <div class="sidebar-body">
                                <table class="table">
                                    <tr>
                                        <td>SERVICE FEES</td>
                                        <td>&#x20A6;{{number_format(($selectedRoom['customerMarkUp']/100),2)}}</td>
                                    </tr>
                                    <tr>
                                        <td>TAXES</td>
                                        <td>&#x20A6;{{number_format(($selectedRoom['vat']/100),2)}}</td>
                                    </tr>
                                    <tr>
                                        <td>DISCOUNT</td>
                                        <td>&#x20A6; {{number_format(($selectedRoom['customerMarkDown']/100),2)}} </td>
                                    </tr>
                                    <tr>
                                        <td>TOTAL PRICE</td>
                                        <td class="total">&#x20A6;{{number_format(($selectedRoom['customerTotalAmount']/100),2)}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="sidebar-item contact-box">
                            <h4><i class="fa fa-phone"></i>Need Help?</h4>
                            <div class="sidebar-body text-center">
                                <p>Need Help? Call us or drop a message. Our agents will be in touch shortly.</p>
                                <h3><a href="tel:{{\App\Services\PortalConfig::$adminBookingsNumber}}">{{\App\Services\PortalConfig::$adminBookingsNumber}}</a></h3>
                                <h3><a href="mailto:{{\App\Services\PortalConfig::$adminBookingsEmail}}">{{\App\Services\PortalConfig::$adminBookingsEmail}}</a></h3>
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
    <script src="{{asset('frontend/assets/js/pages/hotel/hotel_booking.js')}}"></script>
@endsection

@section('css')

@endsection