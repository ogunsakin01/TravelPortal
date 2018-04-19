@extends('layouts.app')

@section('page-title') Flight Result  @endsection

@section('content')
    @php
    $AmadeusConfig = new \App\Services\AmadeusConfig();
    $AmadeusHelper = new \App\Services\AmadeusHelper();
    @endphp

    <!-- START: PAGE TITLE -->
    <div class="row page-title">
        <div class="container clear-padding text-center flight-title">
            <h3>Your Booking</h3>
            @foreach($flightSearchParam['flight_search'] as $i => $searchParam)
            <h5><i class="fa fa-plane"></i>{{$searchParam['departure_city']}}<i class="fa fa-long-arrow-right"></i>{{$searchParam['destination_city']}}</h5>
            @endforeach
            <span> <i class="fa fa-male"></i>Traveller(s) - {{$flightSearchParam['no_of_adult']}} Adult, {{$flightSearchParam['no_of_child']}} child, {{$flightSearchParam['no_of_infant']}} Infant </span>
        </div>
    </div>
    <!-- END: PAGE TITLE -->

    <!-- START: BOOKING TAB -->
    <div class="row booking-tab">
        <div class="container clear-padding">
            <ul class="nav nav-tabs">
                <li class="active col-md-4 col-md-offset-2 col-sm-4 col-sm-offset-2 col-xs-4 col-xs-offset-2"><a data-toggle="tab" href="#review-booking" class="text-center"><i class="fa fa-edit"></i> <span>Review Booking</span></a></li>
                <li class="col-md-4  col-sm-4 col-xs-4"><a data-toggle="tab" href="#passenger-info" class="text-center"><i class="fa fa-male"></i> <span>Passenger Info</span></a></li>
            </ul>
        </div>
    </div>
    <div class="row booking-detail">
        <div class="container clear-padding">
            <div class="tab-content">
                <div id="review-booking" class="tab-pane fade in active">
                    <div class="col-md-8 col-sm-8">
                        @foreach($selectedItinerary['originDestinations'] as $serial => $segment)
                         @php
                             $segment = (array)$segment;
                         @endphp
                        <div class="flight-list-v2">
                            <div class="flight-list-main">
                                <div class="col-md-2 col-sm-2 text-center airline">
                                    <img src="{{\App\Services\AmadeusConfig::airlineLogo($segment['marketingAirlineCode'])}}" style="height: 90px; width: 90px;" alt="{{$segment['marketingAirlineCode']}}">
                                    <h6>{{$segment['marketingAirlineCode']}}-{{$segment['flightNumber']}}</h6>
                                </div>
                                <div class="col-md-3 col-sm-3 departure">
                                    <h3><i class="fa fa-plane"></i> {{$segment['departureAirportCode']}} {{date('H:i',strtotime($segment['departureDateTime']))}}</h3>
                                    <h5 class="bold">{{date('D, d M',strtotime($segment['departureDateTime']))}}</h5>
                                    <h5>{{$segment['departureAirportName']}}</h5>
                                </div>
                                <div class="col-md-4 col-sm-4 stop-duration">
                                    <div class="flight-direction">
                                    </div>
                                    <div class="stop">
                                    </div>
                                    <div class="stop-box">
                                        <span>0 Stop</span>
                                    </div>
                                    <div class="duration text-center">
                                        <span><i class="fa fa-clock-o"></i> {{$segment['journeyDuration']}}</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 destination">
                                    <h3><i class="fa fa-plane fa-rotate-90"></i> {{$segment['arrivalAirportCode']}} {{date('H:i',strtotime($segment['arrivalDateTime']))}}</h3>
                                    <h5 class="bold">{{date('D, d M',strtotime($segment['arrivalDateTime']))}}</h5>
                                    <h5>{{$segment['arrivalAirportName']}}</h5>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="flight-list-footer">
                                <div class="col-md-6 col-sm-6 col-xs-6 sm-invisible">
                                    <span><i class="fa fa-plane"></i> {{$segment['cabin']}}</span>
                                </div>
                            </div>
                        </div>
                        <br/>
                        @endforeach
                        <div class="row">
                            <div class="col-md-3" style="text-align: center">
                                <div class="form-group">
                                    <a class="continue btn-block btn_travel_portal">Continue</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 booking-sidebar">
                        <div class="sidebar-item">
                            <h4><i class="fa fa-bookmark"></i>Fare Details</h4>
                            <div class="sidebar-body">
                                @if($selectedItinerary['priceChange'] != 0)
                                <div class="alert alert-info">
                                    <strong><i class="fa fa-info"></i></strong> The Itinerary price changed by &#x20a6;{{number_format($selectedItinerary['priceChange'], 2)}}.
                                </div>
                                @endif

                                <table class="table">
                                    @foreach($selectedItinerary['itineraryPassengerInfo'] as $serial => $passenger)
                                        @php $passenger = (array)$passenger; @endphp
                                    <tr>
                                        <td>{{$passenger['passengerType']}} {{$passenger['quantity']}}</td>
                                        <td>&#x20a6;{{number_format(($passenger['price']/100),2)}}</td>
                                    </tr>
                                    @endforeach

                                         @if(auth()->user())
                                        @role('agent')
                                        <tr>
                                            <td>Service Fee</td>
                                            <td>&#x20a6;{{number_format($selectedItinerary['adminToCustomerMarkup'] / 100, 2)}}</td>
                                        </tr>
                                        @endrole
                                        @role('customer')
                                        <tr>
                                            <td>Service Fee</td>
                                            <td>&#x20a6;{{number_format($selectedItinerary['adminToCustomerMarkup']/ 100, 2)}}</td>
                                        </tr>
                                        @endrole
                                        @else
                                            <tr>
                                                <td>Service Fee</td>
                                                <td>&#x20a6;{{number_format($selectedItinerary['adminToCustomerMarkup']/ 100, 2)}}</td>
                                            </tr>
                                             @endif
                                        <tr>
                                            <td>Vat</td>
                                            <td>&#x20a6;{{number_format($selectedItinerary['vat']/100, 2)}}</td>
                                        </tr>
                                        <tr>
                                            <td>Discount</td>
                                            <td>&#x20a6;{{number_format($selectedItinerary['airlineMarkdown']/100, 2)}}</td>
                                        </tr>
                                        @if(auth()->user())
                                        @role('agent')
                                        <tr>
                                            <td>Service Fee</td>
                                            <td>&#x20a6;{{number_format($selectedItinerary['agentTotal'] / 100, 2)}}</td>
                                        </tr>
                                        @endrole
                                        @role('customer')
                                        <tr>
                                            <td>You Pay</td>
                                            <td class="total">&#x20a6;{{number_format($selectedItinerary['customerTotal']/ 100, 2)}}</td>
                                        </tr>
                                        @endrole
                                        @role('admin')
                                        <tr>
                                            <td>You Pay</td>
                                            <td class="total">&#x20a6;{{number_format($selectedItinerary['adminTotal']/ 100, 2)}}</td>
                                        </tr>
                                        @endrole
                                            @else
                                            <tr>
                                                <td>You Pay</td>
                                                <td class="total">&#x20a6;{{number_format($selectedItinerary['customerTotal']/ 100, 2)}}</td>
                                            </tr>
                                            @endif
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
                        <div class="login-box">
                            <h3>Sign In</h3>
                            <div class="booking-form">
                                    <form >
                                        <div class="row">
                                           <div class="col-md-4">,
                                               <div class="form-group">
                                                   <label>Email</label>
                                                   <input class="form-control" type="email" name="emailid" placeholder="Enter Your Email" required>
                                               </div>
                                           </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input class="form-control" type="password" name="password" placeholder="Enter Password" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group" style="text-align: center">
                                                    <label></label>
                                                    <button class="login">Login</button>
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
                        </div>
                        <br/>
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
                        <br/>
                        <div class="passenger-detail">
                            <h3>Passenger Details</h3>
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
                            <h4><i class="fa fa-bookmark"></i>Fare Details</h4>
                            <div class="sidebar-body">
                                @if($selectedItinerary['priceChange'] != 0)
                                    <div class="alert alert-info">
                                        <strong><i class="fa fa-info"></i></strong> The Itinerary price changed by &#x20a6;{{number_format($selectedItinerary['priceChange'], 2)}}.
                                    </div>
                                @endif

                                <table class="table">
                                    @foreach($selectedItinerary['itineraryPassengerInfo'] as $serial => $passenger)
                                        @php $passenger = (array)$passenger; @endphp
                                        <tr>
                                            <td>{{$passenger['passengerType']}} {{$passenger['quantity']}}</td>
                                            <td>&#x20a6;{{number_format(($passenger['price']/100),2)}}</td>
                                        </tr>
                                    @endforeach

                                    @if(auth()->user())
                                        @role('agent')
                                        <tr>
                                            <td>Service Fee</td>
                                            <td>&#x20a6;{{number_format($selectedItinerary['adminToCustomerMarkup'] / 100, 2)}}</td>
                                        </tr>
                                        @endrole
                                        @role('customer')
                                        <tr>
                                            <td>Service Fee</td>
                                            <td>&#x20a6;{{number_format($selectedItinerary['adminToCustomerMarkup']/ 100, 2)}}</td>
                                        </tr>
                                        @endrole
                                    @else
                                        <tr>
                                            <td>Service Fee</td>
                                            <td>&#x20a6;{{number_format($selectedItinerary['adminToCustomerMarkup']/ 100, 2)}}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td>Vat</td>
                                        <td>&#x20a6;{{number_format($selectedItinerary['vat']/100, 2)}}</td>
                                    </tr>
                                    <tr>
                                        <td>Discount</td>
                                        <td>&#x20a6;{{number_format($selectedItinerary['airlineMarkdown']/100, 2)}}</td>
                                    </tr>
                                    @if(auth()->user())
                                        @role('agent')
                                        <tr>
                                            <td>Service Fee</td>
                                            <td>&#x20a6;{{number_format($selectedItinerary['agentTotal'] / 100, 2)}}</td>
                                        </tr>
                                        @endrole
                                        @role('customer')
                                        <tr>
                                            <td>You Pay</td>
                                            <td class="total">&#x20a6;{{number_format($selectedItinerary['customerTotal']/ 100, 2)}}</td>
                                        </tr>
                                        @endrole
                                        @role('admin')
                                        <tr>
                                            <td>You Pay</td>
                                            <td class="total">&#x20a6;{{number_format($selectedItinerary['adminTotal']/ 100, 2)}}</td>
                                        </tr>
                                        @endrole
                                    @else
                                        <tr>
                                            <td>You Pay</td>
                                            <td class="total">&#x20a6;{{number_format($selectedItinerary['customerTotal']/ 100, 2)}}</td>
                                        </tr>
                                    @endif
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
            </div>
        </div>
    </div>

@endsection


@section('javascript')
<script src="{{asset('assets/js/pages/flight/itinerary_booking.js')}}"></script>
@endsection
@section('css')

@endsection