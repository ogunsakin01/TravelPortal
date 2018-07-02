@extends('layouts.app')

@section('page-title') Welcome  @endsection

@section('content')
    <div class="row vertical-search">
        <div class="container clear-padding">
            <div class="search-section">
                <div role="tabpanel">
                    <div class="col-md-2 col-sm-2 vertical-tab">
                        <!-- BEGIN: CATEGORY TAB -->
                        <ul class="nav nav-tabs search-top" role="tablist" id="searchTab">
                            <li role="presentation" class="active">
                                <a href="#flight" aria-controls="flight" role="tab" data-toggle="tab">
                                    <i class="fa fa-plane"></i>
                                    <span>FLIGHTS</SPAN>
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#hotel" aria-controls="hotel" role="tab" data-toggle="tab">
                                    <i class="fa fa-bed"></i>
                                    <span>HOTELS</span>
                                </a>
                            </li>
                        </ul>
                        <!-- END: CATEGORY TAB -->
                    </div>
                    <div class="col-md-10 col-sm-10 vertical-tab-pannel">
                        <!-- BEGIN: TAB PANELS -->
                        <div class="tab-content">
                            <!-- BEGIN: FLIGHT SEARCH -->
                            <div role="tabpanel" class="tab-pane active" id="flight">
                                <div class="col-md-12 clear-padding">
                                        <div class="col-md-12 product-search-title">Book Flight Tickets</div>
                                        <div class="col-md-12 search-col-padding">
                                            <label class="radio-inline">
                                                <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="One Way"> One Way
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="inlineRadioOptions" id="inlineRadio2" checked value="Round Trip"> Round Trip
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="Multi Destination"> Multi Destination
                                            </label>
                                        </div>
                                        <div class="hidden" id="one_way_flight_search_holder">
                                            <div class="clearfix"></div>
                                            <div class="col-md-4 col-sm-4 search-col-padding">
                                                <label>Departure City</label>
                                                <div class="input-group">
                                                    <input type="text" name="departure_city" class="form-control type-ahead one_way_departure_city" required placeholder="E.g. London">
                                                    <span class="input-group-addon"><i class="fa fa-map-marker fa-fw"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 search-col-padding">
                                                <label>Destination City</label>
                                                <div class="input-group">
                                                    <input type="text" name="destination_city" class="form-control type-ahead one_way_destination_city"  required placeholder="E.g. New York">
                                                    <span class="input-group-addon"><i class="fa fa-map-marker fa-fw"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 search-col-padding">
                                                <label>Departure Date</label>
                                                <div class="input-group">
                                                    <input type="text" name="departure_date" class="form-control one_way_departure_date date-picker" placeholder="DD/MM/YYYY">
                                                    <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-md-4 col-sm-4 search-col-padding">
                                                <div class="form-group">
                                                    <label>Adults <small>Above 12yrs</small></label>
                                                    <select name="adult_count" class="selectpicker one_way_adult_count">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 search-col-padding">
                                                <div class="form-group">
                                                    <label>Child <small>2 - 12yrs</small></label>
                                                    <select name="child_count" class="selectpicker one_way_child_count">
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 search-col-padding">
                                                <div class="form-group">
                                                    <label>Infants <small>below 2yrs</small></label>
                                                    <select name="infant_count" class="selectpicker one_way_infant_count">
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>
                                            <div class="col-md-12 search-col-padding">
                                                <button type="button" class="search-button btn transition-effect one_way_search_flight">Search Flights</button>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div  id="round_trip_flight_search_holder">
                                            <div class="clearfix"></div>
                                            <div class="col-md-6 col-sm-6 search-col-padding">
                                                <label>Departure City</label>
                                                <div class="input-group">
                                                    <input type="text" name="departure_city" class="form-control type-ahead round_trip_departure_city" required placeholder="E.g. London">
                                                    <span class="input-group-addon"><i class="fa fa-map-marker fa-fw"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 search-col-padding">
                                                <label>Destination City</label>
                                                <div class="input-group">
                                                    <input type="text" name="destination_city" class="form-control type-ahead round_trip_destination_city"  required placeholder="E.g. New York">
                                                    <span class="input-group-addon"><i class="fa fa-map-marker fa-fw"></i></span>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-md-6 col-sm-6 search-col-padding">
                                                <label>Departure Date</label>
                                                <div class="input-group">
                                                    <input type="text" name="departure_date" class="form-control round_trip_departure_date date-picker" placeholder="DD/MM/YYYY">
                                                    <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 search-col-padding">
                                                <label>Return Date</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control round_trip_return_date date-picker" name="return_date" placeholder="DD/MM/YYYY">
                                                    <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-md-4 col-sm-4 search-col-padding">
                                                <div class="form-group">
                                                    <label>Adults <small>Above 12yrs</small></label>
                                                    <select name="adult_count" class="selectpicker round_trip_adult_count">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 search-col-padding">
                                                <div class="form-group">
                                                    <label>Child <small>2 - 12yrs</small></label>
                                                    <select name="child_count" class="selectpicker round_trip_child_count">
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 search-col-padding">
                                                <div class="form-group">
                                                    <label>Infants <small>below 2yrs</small></label>
                                                    <select name="infant_count" class="selectpicker round_trip_infant_count">
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-md-12 search-col-padding">
                                                <button type="button" class="search-button btn transition-effect round_trip_search_flight">Search Flights</button>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="hidden" id="multi_destination_flight_search_holder">
                                            <div class="clearfix"></div>
                                            <div class="multi_destination_origin_destinations">
                                                <div class="col-md-4 col-sm-4 search-col-padding">
                                                    <div class="form-group">
                                                        <label>Departure City</label>
                                                        <input type="text" name="departure_city" class="form-control multi_destination_departure_city type-ahead" placeholder="Airport or City Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-4 search-col-padding">
                                                    <div class="form-group">
                                                        <label>Destination City</label>
                                                        <input type="text" name="destination_city" class="form-control multi_destination_destination_city type-ahead" placeholder="Airport or City Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-3 search-col-padding">
                                                    <div class="form-group">
                                                        <label>Departure Date</label>
                                                        <input type="text" class="form-control multi_destination_departure_date date-picker" name="departure_date" placeholder="DD/MM/YYYY">
                                                    </div>
                                                </div>
                                                <div class="col-md-1 col-sm-1 search-col-padding">

                                                    <div class="form-group">
                                                        <label>&nbsp;</label>
                                                        <button class="btn btn-outline-primary btn-group" id="add_new_trip" type="button"><i class="fa fa-plus"></i> Add </button>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>

                                            <div class="col-md-4 col-sm-4 search-col-padding">
                                                <div class="form-group">
                                                    <label>Adults <small>Above 12yrs</small></label>
                                                    <select name="adult_count" class="selectpicker multi_destination_adult_count">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 search-col-padding">
                                                <div class="form-group">
                                                    <label>Child <small>2 - 12yrs</small></label>
                                                    <select name="child_count" class="selectpicker multi_destination_child_count">
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 search-col-padding">
                                                <div class="form-group">
                                                    <label>Infants <small>below 2yrs</small></label>
                                                    <select name="infant_count" class="selectpicker multi_destination_infant_count">
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-md-12 search-col-padding">
                                                <button type="button" id="search_multi_flight" class="search-button btn transition-effect multi_destination_search_flight">Search Flights</button>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <!-- END: FLIGHT SEARCH -->

                            <!-- START: HOTEL SEARCH -->
                            <div role="tabpanel" class="tab-pane" id="hotel">
                                <div class="col-md-8">
                                    <form >
                                        <div class="col-md-12 product-search-title">Book Hotel Rooms</div>
                                        <div class="col-md-12 col-sm-12 search-col-padding">
                                            <label>I Want To Go</label>
                                            <div class="input-group">
                                                <input type="text" name="destination-city" class="form-control type-ahead hotel_city" required placeholder="E.g. City, Airport ...">
                                                <span class="input-group-addon"><i class="fa fa-map-marker fa-fw"></i></span>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-6 col-sm-6 search-col-padding">
                                            <label>Check - In</label>
                                            <div class="input-group">
                                                <input type="text" name="check-in" id="check_in" class="form-control date-picker check_in_date" placeholder="DD/MM/YYYY">
                                                <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 search-col-padding">
                                            <label>Check - Out</label>
                                            <div class="input-group">
                                                <input type="text" name="check-out" id="check_out" class="form-control date-picker check_out_date" placeholder="DD/MM/YYYY">
                                                <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-3 col-sm-3 search-col-padding">
                                            <label>Adult</label><br>
                                            <input id="hotel_adult_count" name="adult_count" value="1" class="form-control quantity-padding adult_count">
                                        </div>
                                        <div class="col-md-3 col-sm-3 search-col-padding">
                                            <label>Child</label><br>
                                            <input type="text" id="hotel_child_count" name="child_count" value="1" class="form-control quantity-padding child_count">
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-12 search-col-padding">
                                            <button type="button" class="search-button btn transition-effect hotel_search">Search Hotels</button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                                <div class="offer-box col-md-4">
                                    <div class="item">
                                        <img src="{{asset('frontend/assets/images/tour1.jpg')}}" alt="cruise">
                                        <h4>Hotels In Paris</h4>
                                        <h5>Starting From $399/Night</h5>
                                        <a href="#">KNOW MORE</a>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <!-- END: HOTEL SEARCH -->
                        </div>
                        <!-- END: TAB PANE -->
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- END: SEARCH SECTION -->

    <!-- BEGIN: HOW IT WORK -->
    <section id="how-it-work">
        <div class="row work-row">
            <div class="container">
                <div class="section-title text-center">
                    <h2>LAST MINUTE DEALS</h2>
                    <h4>SAVE MORE</h4>
                </div>
                <div class="owl-carousel" id="lastminute">
                    @foreach($deals as $serial => $deal)
                        <div class="col-grid  bg-white">
                            <div class="wrapper">
                                @if($deal->flight == 1 && $deal->hotel == 0 && $deal->attraction == 0)
                                    <img src="{{\App\Services\AmadeusConfig::cityImage(\App\Services\AmadeusConfig::iataCode($deal->flightDeal->destination))}}" alt="">
                                @else
                                    @if(isset($deal->images[0]['image_path']))
                                        <img src="{{asset($deal->images[0]->image_path)}}" alt="">
                                    @else
                                        @if(isset($deal->hotelDeal['city']))
                                            <img src="{{ \App\Services\AmadeusConfig::cityImage(\App\Services\AmadeusConfig::iataCode($deal->hotelDeal->city)) }}" alt="">
                                        @elseif(isset($deal->attractionDeal['city']))
                                            <img src="{{ \App\Services\AmadeusConfig::cityImage(\App\Services\AmadeusConfig::iataCode($deal->attractionDeal->city)) }}">
                                        @elseif(isset($deal->flightDeal['destination']))
                                            <img src="{{ \App\Services\AmadeusConfig::cityImage(\App\Services\AmadeusConfig::iataCode($deal->flightDeal->destination)) }}">
                                        @endif
                                    @endif
                                @endif
                                <h6 class="location">{{$deal->name}}</h6>
                            </div>
                            <div class="body text-center">
                                <h5>{{$deal->name}}</h5>
                                @if($deal->flight == 1) <i class="fa fa-plane"></i> @endif
                                @if($deal->hotel == 1) <i class="fa fa-home"></i> @endif
                                @if($deal->attraction == 1) <i class="fa fa-map-marker"></i> @endif
                                <p class="back-line">Starting From</p>
                                <h3>&#x20a6;{{number_format($deal->adult_price)}}</h3>
                                <p class="text-sm">{{substr($deal->information,0,150)}}</p>
                            </div>
                            <div class="bottom">
                                <a href="{{url('deals/details/'.$deal->id)}}">VIEW DETAIL</a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    <!--END: HOW IT WORK -->

@endsection

@section('javascript')
    <script type="text/javascript">
        /* SLIDER SETTINGS */
        jQuery(function($){
            "use strict";
            $.supersized({
                //Functionality
                slideshow               :   1,		//Slideshow on/off
                autoplay				:	1,		//Slideshow starts playing automatically
                start_slide             :   1,		//Start slide (0 is random)
                random					: 	0,		//Randomize slide order (Ignores start slide)
                slide_interval          :   10000,	//Length between transitions
                transition              :   1, 		//0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
                transition_speed		:	500,	//Speed of transition
                new_window				:	1,		//Image links open in new window/tab
                pause_hover             :   0,		//Pause slideshow on hover
                keyboard_nav            :   0,		//Keyboard navigation on/off
                performance				:	1,		//0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
                image_protect			:	1,		//Disables image dragging and right click with Javascript

                //Size & Position
                min_width		        :   0,		//Min width allowed (in pixels)
                min_height		        :   0,		//Min height allowed (in pixels)
                vertical_center         :   1,		//Vertically center background
                horizontal_center       :   1,		//Horizontally center background
                fit_portrait         	:   1,		//Portrait images will not exceed browser height
                fit_landscape			:   0,		//Landscape images will not exceed browser width

                //Components
                navigation              :   1,		//Slideshow controls on/off
                thumbnail_navigation    :   1,		//Thumbnail navigation
                slide_counter           :   1,		//Display slide numbers
                slide_captions          :   1,		//Slide caption (Pull from "title" in slides array)
                slides 					:  	[		//Slideshow Images
                    {image : 'frontend/assets/images/1.jpg', title : 'Slide 1'},
                    {image : 'frontend/assets/images/2.jpg', title : 'Slide 2'},
                    {image : 'frontend/assets/images/3.jpg', title : 'Slide 3'},
                ]

            });
        });

    </script>
    <script src="{{asset('frontend/assets/js/pages/flight/flight_search_management.js')}}"></script>
    <script src="{{asset('frontend/assets/js/pages/hotel/hotel_search_management.js')}}"></script>

@endsection

@section('css')

@endsection