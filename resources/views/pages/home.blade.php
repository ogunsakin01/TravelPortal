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
                                                <input type="text" name="destination-city" class="form-control" required placeholder="E.g. New York">
                                                <span class="input-group-addon"><i class="fa fa-map-marker fa-fw"></i></span>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-6 col-sm-6 search-col-padding">
                                            <label>Check - In</label>
                                            <div class="input-group">
                                                <input type="text" name="check-in" id="check_in" class="form-control" placeholder="DD/MM/YYYY">
                                                <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 search-col-padding">
                                            <label>Check - Out</label>
                                            <div class="input-group">
                                                <input type="text" name="check-out" id="check_out" class="form-control" placeholder="DD/MM/YYYY">
                                                <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-3 col-sm-3 search-col-padding">
                                            <label>Adult</label><br>
                                            <input id="hotel_adult_count" name="adult_count" value="1" class="form-control quantity-padding">
                                        </div>
                                        <div class="col-md-3 col-sm-3 search-col-padding">
                                            <label>Child</label><br>
                                            <input type="text" id="hotel_child_count" name="child_count" value="1" class="form-control quantity-padding">
                                        </div>
                                        <div class="col-md-3 col-sm-3 search-col-padding">
                                            <label>Rooms</label><br>
                                            <select class="selectpicker" name="rooms">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 col-sm-3 search-col-padding">
                                            <label>Nights</label><br>
                                            <select class="selectpicker" name="nights">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                            </select>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-12 search-col-padding">
                                            <button type="button" class="search-button btn transition-effect">Search Hotels</button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                                <div class="offer-box col-md-4">
                                    <div class="item">
                                        <img src="assets/images/tour1.jpg" alt="cruise">
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
                    <h2>HOW IT WORKS?</h2>
                    <h4>SEARCH - SELECT - BOOK</h4>
                    <div class="space"></div>
                    <p>
                        Lorem Ipsum is simply dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry.<br>
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                    </p>
                </div>
                <div class="work-step">
                    <div class="col-md-4 col-sm-4 first-step text-center">
                        <i class="fa fa-search"></i>
                        <h5>SEARCH</h5>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    </div>
                    <div class="col-md-4 col-sm-4 second-step text-center">
                        <i class="fa fa-heart-o"></i>
                        <h5>SELECT</h5>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    </div>
                    <div class="col-md-4 col-sm-4 third-step text-center">
                        <i class="fa fa-shopping-cart"></i>
                        <h5>BOOK</h5>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END: HOW IT WORK -->

    <!-- START: PRODUCT SECTION-->
    <section class="hotel-product home-product">
        <!-- START: PRODUCT ROW 1 -->
        <div class="row light-row">
            <div class="col-md-6 clear-padding wow slideInLeft">
                <div class="product-wrapper">
                    <div class="col-md-6 col-sm-6 home-product-padding tooltip-right">
                        <h4>Romantic Paris</h4>
                        <h5><i class="fa fa-map-marker"></i> France</h5>
                        <p>Lorem Ipsum is simply dummy text. Lorem Ipsum is simply dummy text of the printing.</p>
                        <div class="rating-box">
                            <div class="pull-left">
                                <img src="assets/images/tripadvisor.png" alt="cruise"><span>4.0/5</span>
                            </div>
                            <div class="pull-right">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><span>4.5/5</span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="pricing-info">
                            <div class="pull-left">
                                <span>$999/Person</span>
                            </div>
                            <div class="pull-right">
                                <a href="#" class="wow fadeIn">BOOK NOW</a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-md-6 col-sm-6 clear-padding image-sm text-center">
                        <img src="assets/images/home2.jpg" alt="cruise">
                        <div class="detail-link-wrapper">
                            <div class="detail-link">
                                <a href="#"><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="product-wrapper">
                    <div class="col-md-6 col-sm-6 clear-padding image-sm text-center">
                        <img src="assets/images/tour1.jpg" alt="cruise">
                        <div class="detail-link-wrapper">
                            <div class="detail-link">
                                <a href="#"><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 home-product-padding tooltip-left">
                        <h4>Blue Beach</h4>
                        <h5><i class="fa fa-map-marker"></i> Dubai</h5>
                        <p>Lorem Ipsum is simply dummy text. Lorem Ipsum is simply dummy text of the printing.</p>
                        <div class="rating-box">
                            <div class="pull-left">
                                <img src="assets/images/tripadvisor.png" alt="cruise"><span>4.0/5</span>
                            </div>
                            <div class="pull-right">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><span>4.5/5</span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="pricing-info">
                            <div class="pull-left">
                                <span>$899/Person</span>
                            </div>
                            <div class="pull-right">
                                <a href="#" class="wow fadeIn">BOOK NOW</a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="clearfix visible-sm-block"></div>
            <div class="col-md-6 clear-padding image-lg wow slideInRight">
                <img src="assets/images/home.jpg" alt="cruise">
                <div class="overlay">
                    <div class="product-detail text-center">
                        <h3>Africa Safari</h3>
                        <h5><i class="fa fa-map-marker"></i> KENYA</h5>
                        <p>Lorem Ipsum is simply dummy text. Lorem Ipsum is simply dummy text of the printing.</p>
                        <div class="rating-box">
                            <div class="pull-left">
                                <img src="assets/images/tripadvisor.png" alt="cruise"><span>4.0/5</span>
                            </div>
                            <div class="pull-right">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><span>4.5/5</span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="pricing-info">
                            <div class="pull-left">
                                <span>$499/Person</span>
                            </div>
                            <div class="pull-right">
                                <a href="#" class="wow fadeIn">BOOK NOW</a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: PRODUCT ROW 1 -->
    </section>
    <!-- END: PRODUCT SECTION -->

    <!-- BEGIN: TOP DESTINATION SECTION -->
    <section id="home-top-destination">
        <div class="row image-background">
            <div class="td-overlay">
                <div class="container">
                    <div class="light-section-title text-center">
                        <h2>TOP DESTINATION</h2>
                        <h4>EXPLORE</h4>
                        <div class="space"></div>
                        <p>
                            Lorem Ipsum is simply dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry.<br>
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                        </p>
                    </div>
                    <div class="col-md-10 col-md-offset-1 on-top clear-padding">
                        <div class="col-md-6 col-sm-6 td-product text-center clear-padding wow slideInUp" data-wow-delay="0.1s">
                            <img src="assets/images/tour1.jpg" alt="cruise">
                            <div class="overlay">
                                <div class="wrapper">
                                    <h5>FRANCE</h5>
                                    <h3><span>ROMANTIC PARIS</span></h3>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.</p>
                                    <a href="#">KNOW MORE</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 td-product text-center clear-padding wow slideInUp" data-wow-delay="0.2s">
                            <img src="assets/images/tour1.jpg" alt="cruise">
                            <div class="overlay">
                                <div class="wrapper">
                                    <h5>BANGKOK</h5>
                                    <h3><span>DISENYLAND BANGKOK</span></h3>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.</p>
                                    <a href="#">KNOW MORE</a>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix visible-md-block"></div>
                        <div class="col-md-6 col-sm-6 td-product text-center clear-padding wow slideInUp" data-wow-delay="0.1s">
                            <img src="assets/images/tour1.jpg" alt="cruise">
                            <div class="overlay">
                                <div class="wrapper">
                                    <h5>DUBAI</h5>
                                    <h3><span>SKY HIGH DUBAI</span></h3>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.</p>
                                    <a href="#">KNOW MORE</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 td-product text-center clear-padding wow slideInUp" data-wow-delay="0.2s">
                            <img src="assets/images/tour1.jpg" alt="cruise">
                            <div class="overlay">
                                <div class="wrapper">
                                    <h5>AUSTRIA</h5>
                                    <h3><span>HILLY VIEW</span></h3>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.</p>
                                    <a href="#">KNOW MORE</a>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix visible-md-block"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END: TOP DESTINATION SECTION -->

    <!-- BEGIN: RECENT BLOG POST -->
    <section id="recent-blog">
        <div class="row top-offer">
            <div class="container">
                <div class="section-title text-center">
                    <h2>RECENT BLOG POSTS</h2>
                    <h4>NEWS</h4>
                </div>
                <div class="owl-carousel" id="post-list">
                    <div class="room-grid-view wow slideInUp" data-wow-delay="0.1s">
                        <img src="assets/images/offer1.jpg" alt="cruise">
                        <div class="room-info">
                            <div class="post-title">
                                <h5>POST TITLE GOES HERE</h5>
                                <p><i class="fa fa-calendar"></i> Jul 15, 2015</p>
                            </div>
                            <div class="post-desc">
                                <p>Lorem Ipsum is simply dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                            <div class="room-book">
                                <div class="col-md-8 col-sm-6 col-xs-6 clear-padding post-alt">
                                    <h5><i class="fa fa-comments"></i> 2 <i class="fa fa-share-alt"></i> 20 </h5>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-6 clear-padding">
                                    <a href="#" class="text-center">MORE</a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="room-grid-view wow slideInUp" data-wow-delay="0.2s">
                        <img src="assets/images/offer2.jpg" alt="cruise">
                        <div class="room-info">
                            <div class="post-title">
                                <h5>POST TITLE GOES HERE</h5>
                                <p><i class="fa fa-calendar"></i> Jul 15, 2015</p>
                            </div>
                            <div class="post-desc">
                                <p>Lorem Ipsum is simply dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                            <div class="room-book">
                                <div class="col-md-8 col-sm-6 col-xs-6 clear-padding post-alt">
                                    <h5><i class="fa fa-comments"></i> 2 <i class="fa fa-share-alt"></i> 20 </h5>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-6 clear-padding">
                                    <a href="#" class="text-center">MORE</a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="room-grid-view wow slideInUp" data-wow-delay="0.3s">
                        <img src="assets/images/offer3.jpg" alt="cruise">
                        <div class="room-info">
                            <div class="post-title">
                                <h5>POST TITLE GOES HERE</h5>
                                <p><i class="fa fa-calendar"></i> Jul 15, 2015</p>
                            </div>
                            <div class="post-desc">
                                <p>Lorem Ipsum is simply dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                            <div class="room-book">
                                <div class="col-md-8 col-sm-6 col-xs-6 clear-padding post-alt">
                                    <h5><i class="fa fa-comments"></i> 2 <i class="fa fa-share-alt"></i> 20 </h5>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-6 clear-padding">
                                    <a href="#" class="text-center">MORE</a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="room-grid-view wow slideInUp" data-wow-delay="0.4s">
                        <img src="assets/images/offer4.jpg" alt="cruise">
                        <div class="room-info">
                            <div class="post-title">
                                <h5>POST TITLE GOES HERE</h5>
                                <p><i class="fa fa-calendar"></i> Jul 15, 2015</p>
                            </div>
                            <div class="post-desc">
                                <p>Lorem Ipsum is simply dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                            <div class="room-book">
                                <div class="col-md-8 col-sm-6 col-xs-6 clear-padding post-alt">
                                    <h5><i class="fa fa-comments"></i> 2 <i class="fa fa-share-alt"></i> 20 </h5>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-6 clear-padding">
                                    <a href="#" class="text-center">MORE</a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="room-grid-view wow slideInUp" data-wow-delay="0.5s">
                        <img src="assets/images/offer3.jpg" alt="cruise">
                        <div class="room-info">
                            <div class="post-title">
                                <h5>POST TITLE GOES HERE</h5>
                                <p><i class="fa fa-calendar"></i> Jul 15, 2015</p>
                            </div>
                            <div class="post-desc">
                                <p>Lorem Ipsum is simply dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                            <div class="room-book">
                                <div class="col-md-8 col-sm-6 col-xs-6 clear-padding post-alt">
                                    <h5><i class="fa fa-comments"></i> 2 <i class="fa fa-share-alt"></i> 20 </h5>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-6 clear-padding">
                                    <a href="#" class="text-center">MORE</a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="room-grid-view wow slideInUp" data-wow-delay="0.6s">
                        <img src="assets/images/offer2.jpg" alt="cruise">
                        <div class="room-info">
                            <div class="post-title">
                                <h5>POST TITLE GOES HERE</h5>
                                <p><i class="fa fa-calendar"></i> Jul 15, 2015</p>
                            </div>
                            <div class="post-desc">
                                <p>Lorem Ipsum is simply dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                            <div class="room-book">
                                <div class="col-md-8 col-sm-6 col-xs-6 clear-padding post-alt">
                                    <h5><i class="fa fa-comments"></i> 2 <i class="fa fa-share-alt"></i> 20 </h5>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-6 clear-padding">
                                    <a href="#" class="text-center">MORE</a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END: RECENT BLOG POST -->

    <!-- START: WHY CHOOSE US SECTION -->
    <section id="why-choose-us">
        <div class="row choose-us-row">
            <div class="container clear-padding">
                <div class="light-section-title text-center">
                    <h2>WHY CHOOSE US?</h2>
                    <h4>REASONS TO TRUST US</h4>
                    <div class="space"></div>
                    <p>
                        Lorem Ipsum is simply dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry.<br>
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                    </p>
                </div>
                <div class="col-md-4 col-sm-4 wow slideInLeft">
                    <div class="choose-us-item text-center">
                        <div class="choose-icon"><i class="fa fa-suitcase"></i></div>
                        <h4>Handpicked Tour</h4>
                        <p>Lorem Ipsum is simply dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        <a href="#">KNOW MORE</a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 wow slideInUp">
                    <div class="choose-us-item text-center">
                        <div class="choose-icon"><i class="fa fa-phone"></i></div>
                        <h4>Dedicated Support</h4>
                        <p>Lorem Ipsum is simply dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        <a href="#">KNOW MORE</a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 wow slideInRight">
                    <div class="choose-us-item text-center">
                        <div class="choose-icon"><i class="fa fa-smile-o"></i></div>
                        <h4>Lowest Price</h4>
                        <p>Lorem Ipsum is simply dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        <a href="#">KNOW MORE</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END: WHY CHOOSE US SECTION -->

    <!-- START: HOT  DEALS -->
    <section>
        <div class="row hot-deals">
            <div class="container clear-padding">
                <div class="section-title text-center">
                    <h2>HOT DEALS</h2>
                    <h4>SAVE MORE</h4>
                </div>
                <div role="tabpanel" class="text-center">
                    <!-- BEGIN: CATEGORY TAB -->
                    <ul class="nav nav-tabs" role="tablist" id="hotDeal">
                        <li role="presentation" class="active text-center">
                            <a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">
                                <i class="fa fa-bed"></i>
                                <span>HOTELS</SPAN>
                            </a>
                        </li>
                        <li role="presentation" class="text-center">
                            <a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">
                                <i class="fa fa-suitcase"></i>
                                <span>HOLIDAYS</SPAN>
                            </a>
                        </li>
                        <li role="presentation" class="text-center">
                            <a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab">
                                <i class="fa fa-plane"></i>
                                <span>FLIGHTS</SPAN>
                            </a>
                        </li>
                        <li role="presentation" class="text-center">
                            <a href="#tab4" aria-controls="tab4" role="tab" data-toggle="tab">
                                <i class="fa fa-taxi"></i>
                                <span>CARS</SPAN>
                            </a>
                        </li>
                        <li role="presentation" class="text-center">
                            <a href="#tab5" aria-controls="tab5" role="tab" data-toggle="tab">
                                <i class="fa fa-bed"></i>
                                <span>HOTEL+FLIGHTS</SPAN>
                            </a>
                        </li>
                    </ul>
                    <!-- END: CATEGORY TAB -->
                    <div class="clearfix"></div>
                    <!-- BEGIN: TAB PANELS -->
                    <div class="tab-content">
                        <!-- BEGIN: FLIGHT SEARCH -->
                        <div role="tabpanel" class="tab-pane active fade in" id="tab1">
                            <div class="col-md-6 hot-deal-list wow slideInLeft">
                                <div class="item">
                                    <div class="col-xs-3">
                                        <img src="assets/images/offer1.jpg" alt="Cruise">
                                    </div>
                                    <div class="col-md-7 col-xs-6">
                                        <h5>Hotel Grand Lilly</h5>
                                        <p class="location"><i class="fa fa-map-marker"></i> New York, USA</p>
                                        <p class="text-sm">Lorem Ipsum is simply dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                    <div class="col-md-2 col-xs-3">
                                        <h4>$499</h4>
                                        <h6>Per Night</h6>
                                        <a href="#">BOOK</a>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="item">
                                    <div class="col-xs-3">
                                        <img src="assets/images/offer2.jpg" alt="Cruise">
                                    </div>
                                    <div class="col-md-7 col-xs-6">
                                        <h5>Royal Resort</h5>
                                        <p class="location"><i class="fa fa-map-marker"></i> New York, USA</p>
                                        <p class="text-sm">Lorem Ipsum is simply dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                    <div class="col-md-2 col-xs-3">
                                        <h4>$399</h4>
                                        <h6>Per Night</h6>
                                        <a href="#">BOOK</a>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="item">
                                    <div class="col-xs-3">
                                        <img src="assets/images/offer3.jpg" alt="Cruise">
                                    </div>
                                    <div class="col-md-7 col-xs-6">
                                        <h5>Hotel Grand Lilly</h5>
                                        <p class="location"><i class="fa fa-map-marker"></i> New York, USA</p>
                                        <p class="text-sm">Lorem Ipsum is simply dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                    <div class="col-md-2 col-xs-3">
                                        <h4>$499</h4>
                                        <h6>Per Night</h6>
                                        <a href="#">BOOK</a>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-md-6 hot-deal-grid wow slideInRight">
                                <div class="col-sm-6 item">
                                    <div class="wrapper">
                                        <img src="assets/images/tour1.jpg" alt="Cruise">
                                        <h5>Paris Starting From $49/Night</h5>
                                        <a href="#">DETAILS</a>
                                    </div>
                                </div>
                                <div class="col-sm-6 item">
                                    <div class="wrapper">
                                        <img src="assets/images/tour1.jpg" alt="Cruise">
                                        <h5>Bangkok Starting From $69/Night</h5>
                                        <a href="#">DETAILS</a>
                                    </div>
                                </div>
                                <div class="col-sm-6 item">
                                    <div class="wrapper">
                                        <img src="assets/images/tour1.jpg" alt="Cruise">
                                        <h5>Dubai Starting From $99/Night</h5>
                                        <a href="#">DETAILS</a>
                                    </div>
                                </div>
                                <div class="col-sm-6 item">
                                    <div class="wrapper">
                                        <img src="assets/images/tour1.jpg" alt="Cruise">
                                        <h5>Italy Starting From $59/Night</h5>
                                        <a href="#">DETAILS</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab2">
                            <div class="col-md-6 hot-deal-list">
                                <div class="item">
                                    <div class="col-xs-3">
                                        <img src="assets/images/offer3.jpg" alt="Cruise">
                                    </div>
                                    <div class="col-md-7 col-xs-6">
                                        <h5>Hotel Grand Lilly</h5>
                                        <p class="location"><i class="fa fa-map-marker"></i> New York, USA</p>
                                        <p class="text-sm">Lorem Ipsum is simply dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                    <div class="col-md-2 col-xs-3">
                                        <h4>$499</h4>
                                        <h6>Per Night</h6>
                                        <a href="#">BOOK</a>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="item">
                                    <div class="col-xs-3">
                                        <img src="assets/images/offer2.jpg" alt="Cruise">
                                    </div>
                                    <div class="col-md-7 col-xs-6">
                                        <h5>Royal Resort</h5>
                                        <p class="location"><i class="fa fa-map-marker"></i> New York, USA</p>
                                        <p class="text-sm">Lorem Ipsum is simply dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                    <div class="col-md-2 col-xs-3">
                                        <h4>$399</h4>
                                        <h6>Per Night</h6>
                                        <a href="#">BOOK</a>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="item">
                                    <div class="col-xs-3">
                                        <img src="assets/images/offer1.jpg" alt="Cruise">
                                    </div>
                                    <div class="col-md-7 col-xs-6">
                                        <h5>Hotel Grand Lilly</h5>
                                        <p class="location"><i class="fa fa-map-marker"></i> New York, USA</p>
                                        <p class="text-sm">Lorem Ipsum is simply dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                    <div class="col-md-2 col-xs-3">
                                        <h4>$499</h4>
                                        <h6>Per Night</h6>
                                        <a href="#">BOOK</a>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-md-6 hot-deal-grid">
                                <div class="col-sm-6 item">
                                    <div class="wrapper">
                                        <img src="assets/images/tour1.jpg" alt="Cruise">
                                        <h5>Paris Starting From $49/Night</h5>
                                        <a href="#">DETAILS</a>
                                    </div>
                                </div>
                                <div class="col-sm-6 item">
                                    <div class="wrapper">
                                        <img src="assets/images/tour1.jpg" alt="Cruise">
                                        <h5>Bangkok Starting From $69/Night</h5>
                                        <a href="#">DETAILS</a>
                                    </div>
                                </div>
                                <div class="col-sm-6 item">
                                    <div class="wrapper">
                                        <img src="assets/images/tour1.jpg" alt="Cruise">
                                        <h5>Dubai Starting From $99/Night</h5>
                                        <a href="#">DETAILS</a>
                                    </div>
                                </div>
                                <div class="col-sm-6 item">
                                    <div class="wrapper">
                                        <img src="assets/images/tour1.jpg" alt="Cruise">
                                        <h5>Italy Starting From $59/Night</h5>
                                        <a href="#">DETAILS</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab3">
                            Lorem Lpsum 3
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab4">
                            Lorem Lpsum 4
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab5">
                            Lorem Lpsum 5
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                    {image : 'assets/images/1.jpg', title : 'Slide 1'},
                    {image : 'assets/images/2.jpg', title : 'Slide 2'},
                    {image : 'assets/images/3.jpg', title : 'Slide 3'},
                ]

            });
        });

    </script>
    <script src="{{asset('assets/js/pages/flight/flight_search_management.js')}}"></script>

@endsection

@section('css')

@endsection