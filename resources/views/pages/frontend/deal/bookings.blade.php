@extends('layouts.app')

@section('page-title') Deals Booking  @endsection

@section('activeDeals') active @endsection

@section('content')

    <div class="inner-banner style-6">
        <img class="center-image" src="{{asset('frontend/img/hotel_booking.jpg')}}" style="height: 40px;" alt="">
        <div class="vertical-align">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-8 col-md-offset-2">
                        <ul class="banner-breadcrumb color-white clearfix">
                            <li><a class="link-blue-2" href="{{url('/')}}">home</a> /</li>
                            <li><span>deal booking</span></li>
                        </ul>
                        <h2 class="color-white">{{$deal->name}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="detail-wrapper">

        <div class="container">
            <div class="row padd-90">
                <div class="col-xs-12 col-md-8">

                    @if($errors->any())
                        @if(is_array($errors->first()))
                            @foreach($errors->first() as $serial => $error)
                                <div class="alert alert-danger">{{$error}}</div>
                            @endforeach
                        @else
                            <div class="alert alert-danger">{{$errors->first()}}</div>
                        @endif
                    @endif
                    <div class="simple-group passenger-info bg-grey-2 detail-block" align="center">
                            <h5 class="color-dark-2">Total Amount</h5>
                            <h4 class="color-dark-2">&#x20a6;<span class="total_booking_amount">{{number_format(($deal->adult_price),2)}}</span></h4>
                    </div>
                    @if(auth()->guest())
                        <div class="simple-group passenger-info bg-grey-2 detail-block">
                            <h4 class="color-dark"><b>Existing users, please login</b>  <button type="button" class="btn btn-primary pull-right sign-in">Log In</button></h4>
                            <div class="sign-in-container hidden">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control login_email dynax_input_2" type="email" name="email" placeholder="Enter Your Email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control login_password dynax_input_2" type="password" name="password" placeholder="Enter Password" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" style="text-align: center">
                                            <label></label>
                                            <button class="login btn btn_travel_portal btn-block btn-group sign-in-submit">Sign In</button>
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
                            </div>
                            <div class="sign-up-container">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Surname</label>
                                            <input name="sur_name" type="text" class="form-control sur_name dynax_input_2" placeholder="Surname (Family name)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>First name</label>
                                            <input name="first_name" type="text" class="form-control first_name dynax_input_2" placeholder="First name (Your name)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Other name</label>
                                            <input name="other_name" type="text" class="form-control other_name dynax_input_2" placeholder="Other name (Your other name)" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input name="email" type="email" class="form-control register_email dynax_input_2" placeholder="Email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input name="phone" type="tel" class="form-control register_phone dynax_input_2" placeholder="Phone number" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input id="password" type="password" class="form-control password dynax_input_2" name="password" placeholder="Password" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input id="password-confirm" type="password" class="form-control password_confirmation dynax_input_2" name="password_confirmation" placeholder="Retype Password">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn_travel_portal sign-up-submit"> Sign Up</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <br/>
                    <div class="detail-block bg-grey-2 passenger-detail @if(auth()->guest()) hidden @endif">
                        <h3>Booking Details</h3>
                        <div class="passenger-detail-body booking-form">
                            <form method="post" action="{{url('deals/booking')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><i class="fa fa-user"></i> Adult</label>
                                            <input type="hidden" name="deal_id" value="{{$deal->id}}"/>
                                            <select class="form-control booking_adult_count dynax_input_2 booking_info" name="booking_adult_count" required>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><i class="fa fa-user"></i> Child</label>
                                            <select class="form-control booking_child_count dynax_input_2 booking_info" name="booking_child_count" required>
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><i class="fa fa-user"></i> Infant</label>
                                            <select class="form-control booking_infant_count dynax_input_2 booking_info" name="booking_infant_count" required>
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <br/>
                                        <div class="input-entry color-3">
                                            <input class="checkbox-form" id="text-1" type="checkbox" name="use_logged_in_user">
                                            <label class="clearfix" for="text-1">
                                                <span class="sp-check"><i class="fa fa-check"></i></span>
                                                <p> Use logged in customer details </p>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label> Title </label>
                                            <select name="title_id" class="form-control booking_title_id dynax_input_2"  required>
                                                @foreach($titles as $t => $title)
                                                    <option value="{{$title->id}}">{{$title->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label><i class="fa fa-user"></i> Surname</label>
                                                    <input name="sur_name" type="text" class="form-control booking_sur_name dynax_input_2" placeholder="Surname (Family name)" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label><i class="fa fa-user"></i> First name</label>
                                                    <input name="first_name" type="text" class="form-control booking_first_name dynax_input_2" placeholder="First name (Your name)" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label><i class="fa fa-user"></i> Other name</label>
                                                    <input name="other_name" type="text" class="form-control booking_other_name dynax_input_2" placeholder="Other name (Your other name)" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><i class="fa fa-envelope"></i> Email</label>
                                            <input name="email" type="email" class="form-control booking_email dynax_input_2" placeholder="Email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><i class="fa fa-phone"></i> Phone</label>
                                            <input name="phone" type="tel" class="form-control booking_phone dynax_input_2" placeholder="Phone number" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn_travel_portal">CONTINUE <i class="fa fa-chevron-right"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <div class="right-sidebar" >
                        <div class="detail-block bg-red-3">
                            <h4 class="color-white">details</h4>
                            <div class="details-desc">
                                <p class="color-pink">DEAL NAME:  <span class="color-white">{{$deal->name}}</span></p>
                                <p class="color-pink">FLIGHT: <span class="color-white"> @if($deal->flight == 1) <i class=" fa fa-check"></i>Available @else <i class=" fa fa-times"></i>Not Available @endif </span></p>
                                <p class="color-pink">HOTEL: <span class="color-white"> @if($deal->hotel == 1) <i class=" fa fa-check"></i>Available @else <i class=" fa fa-times"></i>Not Available @endif </span></p>
                                <p class="color-pink">ATTRACTION: <span class="color-white"> @if($deal->attraction == 1) <i class=" fa fa-check"></i>Available @else <i class=" fa fa-times"></i>Not Available @endif </span></p>
                                <p class="color-pink">ADULT PRICE: <span class="color-white"> {{number_format($deal->adult_price)}} </span></p>
                                <p class="color-pink">CHILD PRICE: <span class="color-white"> {{number_format($deal->child_price)}} </span></p>
                                <p class="color-pink">INFANT PRICE: <span class="color-white"> {{number_format($deal->infant_price)}}  </span></p>
                                <p class="color-pink">CONTACT NUMBER: <span class="color-white"> {{$deal->phone_number}} </span></p>
                            </div>
                        </div>

                        {{--<a href="{{url('/deals')}}"><div class="sidebar-text-label bg-blue-2 color-white">More Deals</div></a>--}}

                        <div class="help-contact bg-grey-2">
                            <h4 class="color-dark-2">Need Help?</h4>
                            <p class="color-grey">Contact us for assistance :</p>
                            <a class="help-phone color-dark-2 link-blue" ><img src="{{asset('frontend/img/detail/phone24.png')}}" alt="phone">{{\App\Services\PortalConfig::$adminCustomerCareNumber}}</a>
                            <a class="help-mail color-dark-2 link-blue" href="mailto:{{\App\Services\PortalConfig::$adminCustomerCareEmail}}"><img src="{{asset('frontend/img/detail/letter.png')}}" alt="email">{{\App\Services\PortalConfig::$adminCustomerCareEmail}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{asset('frontend/assets/js/pages/deal/deal_booking.js')}}"></script>
@endsection