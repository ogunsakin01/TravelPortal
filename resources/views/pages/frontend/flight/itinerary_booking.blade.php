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
                        @if($errors->any())
                        @if(is_array($errors->first()))
                            @foreach($errors->first() as $serial => $error)
                                    <div class="alert alert-danger">{{$error}}</div>
                             @endforeach
                            @else
                                <div class="alert alert-danger">{{$errors->first()}}</div>
                            @endif
                        @endif
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
                                    <strong><i class="fa fa-info"></i></strong> The Itinerary price changed by<br/> <b> &#x20a6; {{number_format(($selectedItinerary['priceChange'] / 100), 2)}}</b>.
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
                        <div class="passenger-detail @if(auth()->guest()) hidden @endif">
                            <h3>Passenger Details</h3>
                            <div class="passenger-detail-body">
                                <form method="post" action="{{url('/book-itinerary')}}">
                                    @csrf
                                    <div class="alert alert-info">
                                        <b>Please enter details as on traveller(s) passport</b>
                                    </div>
                                   @for($i = 0; $i < $flightSearchParam['no_of_adult']; $i++)
                                    <div class="row">
                                        <div class="col-md-12">
                                           <b>Adult [{{$i+1}}]</b>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <select required name="adult_title[]" class="form-control">
                                                    <option value="MR">MR. </option>
                                                    <option value="MSTR">MASTER </option>
                                                    <option value="MS">MS</option>
                                                    <option value="MRS">MRS. </option>
                                                    <option value="MISS">MISS </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="row">
                                                <div class="col-md-4 ol-sm-4">
                                                    <div class="form-group">
                                                       <label>Surname</label>
                                                       <input type="text" name="adult_sur_name[]" required class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-8 ol-sm-8">
                                                    <div class="form-group">
                                                        <label>Given name</label>
                                                        <input type="text" name="adult_given_name[]" required class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   @endfor

                                    @for($i = 0; $i < $flightSearchParam['no_of_child']; $i++)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <b>Child [{{$i+1}}]</b>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <select required name="child_title[]" class="form-control">
                                                    <option value="MR">MR. </option>
                                                    <option value="MSTR">MASTER </option>
                                                    <option value="MS">MS</option>
                                                    <option value="MRS">MRS. </option>
                                                    <option value="MISS">MISS </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="row">
                                                <div class="col-md-4 ol-sm-4">
                                                    <div class="form-group">
                                                        <label>Surname</label>
                                                        <input type="text" name="child_sur_name[]" required class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-8 ol-sm-8">
                                                    <div class="form-group">
                                                        <label>Given name(s)</label>
                                                        <input type="text" name="child_given_name[]" required class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                                <div class="form-group">
                                                    <label>Date Of Birth</label>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                             <select name="child_day_of_birth[]" required class="form-control">
                                                                 @for($day = 1; $day < 32; $day++)
                                                                     <option value="{{sprintf("%01d", $day)}}">{{sprintf("%01d", $day)}}</option>
                                                                 @endfor
                                                             </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <select name="child_month_of_birth[]" required class="form-control">
                                                                @foreach($months as $serial => $month)
                                                                    <option value="{{sprintf("%01d", ($serial+1))}}">{{$month}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <select name="child_year_of_birth[]" required class="form-control">
                                                                @php
                                                                    $cur_year = date('Y');
                                                                    for ($i=2; $i<=14; $i++) {
                                                                      echo '<option value="'. ($cur_year-$i) .'">'. ($cur_year-$i) .'</option>';
                                                                    }
                                                                @endphp
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                     </div>
                                    @endfor

                                    @for($i = 0; $i < $flightSearchParam['no_of_infant']; $i++)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <b>Infant [{{$i+1}}]</b>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <select required name="infant_title[]" class="form-control">
                                                    <option value="MR">MR. </option>
                                                    <option value="MSTR">MASTER </option>
                                                    <option value="MS">MS</option>
                                                    <option value="MRS">MRS. </option>
                                                    <option value="MISS">MISS </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="row">
                                                <div class="col-md-4 ol-sm-4">
                                                    <div class="form-group">
                                                        <label>Surname</label>
                                                        <input type="text" name="infant_sur_name[]" required class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-8 ol-sm-8">
                                                    <div class="form-group">
                                                        <label>Given name(s)</label>
                                                        <input type="text" name="infant_given_name[]" required class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label>Date Of Birth</label>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <select name="infant_day_of_birth[]" required class="form-control">
                                                            @for($day = 1; $day < 32; $day++)
                                                                <option value="{{sprintf("%01d", $day)}}">{{sprintf("%01d", $day)}}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select name="infant_month_of_birth[]" required class="form-control">
                                                            @foreach($months as $serial => $month)
                                                                <option value="{{sprintf("%01d", ($serial+1))}}">{{$month}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select name="infant_year_of_birth[]" required class="form-control">
                                                            @php
                                                                $cur_year = date('Y');
                                                                for ($i=0; $i<=2; $i++) {
                                                                  echo '<option value="'. ($cur_year-$i) .'">'. ($cur_year-$i) .'</option>';
                                                                }
                                                            @endphp
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endfor

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
<script src="{{asset('frontend/assets/js/pages/flight/itinerary_booking.js')}}"></script>
@endsection
@section('css')

@endsection