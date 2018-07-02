@extends('layouts.app')

@section('page-title') Details @endsection

@section('activeDeals') active @endsection

@section('content')

    <!-- START: PAGE TITLE -->
    <div class="row page-title">
        <div class="container clear-padding text-center">
            <h3>WONDERFUL EUROPE</h3>
            <h4>6 Nights/7 Days</h4>
            <span>Paris (2)<i class="fa fa-long-arrow-right"></i>London (2)<i class="fa fa-long-arrow-right"></i>Amesterdam (2)</span>
        </div>
    </div>
    <!-- END: PAGE TITLE -->

    <div class="row package-detail">
        <div class="container clear-padding">
            <div class="main-content col-md-8">

                <!-- START: HOLIDAY GALLERY -->
                <div id="gallery" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#gallery" data-slide-to="0" class="active"></li>
                        <li data-target="#gallery" data-slide-to="1"></li>
                        <li data-target="#gallery" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img src="{{asset('frontend/assets/images/holiday-slide3.jpg')}}" alt="Cruise">
                        </div>
                        <div class="item">
                            <img src="{{asset('frontend/assets/images/holiday-slide4.jpg')}}" alt="Cruise">
                        </div>
                        <div class="item">
                            <img src="{{asset('frontend/assets/images/slide15.jpg')}}" alt="Cruise">
                        </div>
                    </div>
                    <a class="left carousel-control" href="#gallery" role="button" data-slide="prev">
                        <span class="fa fa-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#gallery" role="button" data-slide="next">
                        <span class="fa fa-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <!-- END: HOLIDAY GALLRY -->

                <div class="package-complete-detail">
                    <ul class="nav nav-tabs">
                        <li><a data-toggle="tab" href="#overview"><i class="fa fa-suitcase"></i> <span>Detail</span></a></li>
                        <li><a data-toggle="tab" href="#inclusion"><i class="fa fa-check-square"></i> <span>Inclusion</span></a></li>
                        <li class="active"><a data-toggle="tab" href="#itinerary"><i class="fa fa-street-view"></i> <span>Itinerary</span></a></li>
                        <li><a data-toggle="tab" href="#add-info"><i class="fa fa-info-circle"></i> <span>Additional Info</span></a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="overview" class="tab-pane fade">
                            <h4 class="tab-heading">Overview</h4>
                            <p>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                            </p>
                            <h4 class="tab-heading">Inclusion</h4>
                            <p class="inc">
                                <i class="fa fa-check-circle"></i> Return Economy economy class airfare<br>
                                <i class="fa fa-check-circle"></i> Welcome drinks at hotel<br>
                                <i class="fa fa-check-circle"></i> Stay in 3 star hotel<br>
                                <i class="fa fa-check-circle"></i> Guided tour<br>
                                <i class="fa fa-check-circle"></i> Sighseeing<br>
                                <i class="fa fa-check-circle"></i> Airport transport<br>
                                <i class="fa fa-check-circle"></i> Buffet breakfast<br>
                                <i class="fa fa-check-circle"></i> Return Economy economy class airfare<br>
                                <i class="fa fa-check-circle"></i> Welcome drinks at hotel<br>
                                <i class="fa fa-check-circle"></i> Stay in 3 star hotel<br>
                            </p>
                            <h4 class="tab-heading">Exclusion</h4>
                            <p class="inc">
                                <i class="fa fa-times-circle-o"></i> Travel insurance<br>
                                <i class="fa fa-times-circle-o"></i> Increase in airfare<br>
                                <i class="fa fa-times-circle-o"></i> Airport fees<br>
                                <i class="fa fa-times-circle-o"></i> Travel insurance<br>
                                <i class="fa fa-times-circle-o"></i> Increase in airfare<br>
                                <i class="fa fa-times-circle-o"></i> Airport fees<br>
                            </p>
                        </div>
                        <div id="inclusion" class="tab-pane fade">
                            <h4 class="tab-heading">Inclusion</h4>
                            <div class="inclusion-wrapper">
                                <div class="inclusion-title">
                                    <p><span><i class="fa fa-bed"></i></span>Hotel</p>
                                </div>
                                <div class="inclusion-body">
                                    <h4>Paris, 2 Nights</h4>
                                    <div class="col-md-3 col-sm-3 clear-padding">
                                        <img src="assets/images/offer1.jpg" alt="cruise">
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <h5>Grand Lilly, London <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></h5>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                    </div>
                                    <div class="clearfix"></div>
                                    <h4>London, 2 Nights</h4>
                                    <div class="col-md-3 col-sm-3 clear-padding">
                                        <img src="assets/images/offer2.jpg" alt="cruise">
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <h5>Grand Lilly, London <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></h5>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                    </div>
                                    <div class="clearfix"></div>
                                    <h4>Amsterdam, 2 Nights</h4>
                                    <div class="col-md-3 col-sm-3 clear-padding">
                                        <img src="assets/images/offer3.jpg" alt="cruise">
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <h5>Grand Lilly, London <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></h5>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="inclusion-wrapper">
                                <div class="inclusion-title">
                                    <p><span><i class="fa fa-plane"></i></span>Transport</p>
                                </div>
                                <div class="inclusion-body">
                                    <h4>Return Flight Included</h4>
                                    <div class="flight-inclusion">
                                        <div class="col-md-2 col-sm-2 col-xs-2 text-center">
                                            <img src="assets/images/airline/vistara-2x.png" alt="cruise">
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-3 text-center">
                                            <p>New Delhi</p>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-4 text-center">
                                            <i class="fa fa-long-arrow-right"></i>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-3 text-center">
                                            <p>Paris</p>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="flight-inclusion">
                                        <div class="col-md-2 col-sm-2 col-xs-2 text-center">
                                            <img src="assets/images/airline/indigo-2x.png" alt="cruise">
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-3 text-center">
                                            <p>Paris</p>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-4 text-center">
                                            <i class="fa fa-long-arrow-right"></i>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-3 text-center">
                                            <p>New Delhi</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="inclusion-wrapper">
                                <div class="inclusion-title">
                                    <p><span><i class="fa fa-suitcase"></i></span>Other Inclusion</p>
                                </div>
                                <div class="inclusion-body">
                                    <p class="inc">
                                        <i class="fa fa-check-circle"></i> Return Economy economy class airfare<br>
                                        <i class="fa fa-check-circle"></i> Welcome drinks at hotel<br>
                                        <i class="fa fa-check-circle"></i> Stay in 3 star hotel<br>
                                        <i class="fa fa-check-circle"></i> Guided tour<br>
                                        <i class="fa fa-check-circle"></i> Sighseeing<br>
                                        <i class="fa fa-check-circle"></i> Airport transport<br>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div id="itinerary" class="tab-pane fade in active">
                            <h4 class="tab-heading">Package Itinerary</h4>
                            <div class="daily-schedule">
                                <div class="title">
                                    <p><span>Day 1</span>Paris</p>
                                </div>
                                <div class="daily-schedule-body">
                                    <div class="col-md-4 col-sm-4">
                                        <img src="assets/images/tour1.jpg" alt="cruise">
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 activity">
                                        <h4>Included</h4>
                                        <div class="col-md-6 col-sm-6">
                                            <p><i class="fa fa-check-square"></i> Taxi transfer from airport</p>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <p><i class="fa fa-check-square"></i> Welcome drinks at hotel</p>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-6 col-sm-6">
                                            <p><i class="fa fa-check-square"></i> Buffet dinner</p>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <p><i class="fa fa-check-square"></i> Guided city tour</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="daily-schedule">
                                <div class="title">
                                    <p><span>Day 2</span>Paris City Tour</p>
                                </div>
                                <div class="daily-schedule-body">
                                    <div class="col-md-4 col-sm-4">
                                        <img src="assets/images/tour2.jpg" alt="cruise">
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 activity">
                                        <h4>Included</h4>
                                        <div class="col-md-6 col-sm-6">
                                            <p><i class="fa fa-check-square"></i> Taxi transfer from airport</p>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <p><i class="fa fa-check-square"></i> Welcome drinks at hotel</p>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-6 col-sm-6">
                                            <p><i class="fa fa-check-square"></i> Buffet dinner</p>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <p><i class="fa fa-check-square"></i> Guided city tour</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="daily-schedule">
                                <div class="title">
                                    <p><span>Day 3</span>Amsterdam</p>
                                </div>
                                <div class="daily-schedule-body">
                                    <div class="col-md-4 col-sm-4">
                                        <img src="assets/images/tour3.jpg" alt="cruise">
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 activity">
                                        <h4>Included</h4>
                                        <div class="col-md-6 col-sm-6">
                                            <p><i class="fa fa-check-square"></i> Taxi transfer from airport</p>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <p><i class="fa fa-check-square"></i> Welcome drinks at hotel</p>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-6 col-sm-6">
                                            <p><i class="fa fa-check-square"></i> Buffet dinner</p>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <p><i class="fa fa-check-square"></i> Guided city tour</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="add-info" class="tab-pane fade">
                            <h4 class="tab-heading">Inclusion</h4>
                            <p class="inc">
                                <i class="fa fa-check-circle"></i> Return Economy economy class airfare<br>
                                <i class="fa fa-check-circle"></i> Welcome drinks at hotel<br>
                                <i class="fa fa-check-circle"></i> Stay in 3 star hotel<br>
                                <i class="fa fa-check-circle"></i> Guided tour<br>
                                <i class="fa fa-check-circle"></i> Sighseeing<br>
                                <i class="fa fa-check-circle"></i> Airport transport<br>
                                <i class="fa fa-check-circle"></i> Buffet breakfast<br>
                                <i class="fa fa-check-circle"></i> Return Economy economy class airfare<br>
                                <i class="fa fa-check-circle"></i> Welcome drinks at hotel<br>
                                <i class="fa fa-check-circle"></i> Stay in 3 star hotel<br>
                            </p>
                            <h4 class="tab-heading">Exclusion</h4>
                            <p class="inc">
                                <i class="fa fa-times-circle-o"></i> Travel insurance<br>
                                <i class="fa fa-times-circle-o"></i> Increase in airfare<br>
                                <i class="fa fa-times-circle-o"></i> Airport fees<br>
                                <i class="fa fa-times-circle-o"></i> Travel insurance<br>
                                <i class="fa fa-times-circle-o"></i> Increase in airfare<br>
                                <i class="fa fa-times-circle-o"></i> Airport fees<br>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 package-detail-sidebar">
                <div class="col-md-12 sidebar-wrapper clear-padding">
                    <div class="package-summary sidebar-item">
                        <h4><i class="fa fa-bookmark"></i> Package Summary</h4>
                        <div class="package-summary-body">
                            <h5><i class="fa fa-heart"></i>Theme</h5>
                            <p>Honeymoon, Group, Beach</p>
                            <h5><i class="fa fa-map-marker"></i>Departure From</h5>
                            <p>New Delhi, Mumbai</p>
                            <h5><i class="fa fa-globe"></i>Itinerary</h5>
                            <p>Paris (2), London (2), Amesterdam (2)</p>
                        </div>
                        <div class="package-summary-footer text-center">
                            <div class="col-md-6 col-sm-6 col-xs-6 price">
                                <h5>Starting From</h5>
                                <h5>$999/Person</h5>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 book">
                                <a href="#">BOOK NOW</a>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-booking-box">
                        <h3 class="text-center">MAKE A BOOKING</h3>
                        <div class="booking-box-body">
                            <form >
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label>Start</label>
                                    <div class="input-group margin-bottom-sm">
                                        <input type="text" id="check_in" name="check_in" class="form-control" placeholder="DD/MM/YYYY">
                                        <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label>Duration</label>
                                    <select class="selectpicker" name="rooms">
                                        <option>3 Days</option>
                                        <option>5 Days</option>
                                        <option>1 Week</option>
                                        <option>10 Days</option>
                                        <option>2 Week</option>
                                        <option>15+ Days</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <label>Adult</label>
                                    <select class="selectpicker" name="adult">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <label>Child</label>
                                    <select class="selectpicker" name="child">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                    </select>
                                </div>
                                <div class="room-price">
                                    <div class="col-md-8 col-sm-8 col-xs-8">
                                        <label><input type="checkbox" name="single"><span>Deluxe Single Room</span></label>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <h5>$99/Night</h5>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="room-price">
                                    <div class="col-md-8 col-sm-8 col-xs-8">
                                        <label><input type="checkbox" name="double"><span>Deluxe Double Room</span></label>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <h5>$199/Night</h5>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="room-price">
                                    <div class="col-md-8 col-sm-8 col-xs-8">
                                        <label><input type="checkbox" name="royal"><span>Royal Suite</span></label>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <h5>$299/Night</h5>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="grand-total text-center">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h4>Total $599</h4>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <button type="submit">BOOK</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="assistance-box sidebar-item">
                        <h4><i class="fa fa-phone"></i> Need Assistance</h4>
                        <div class="assitance-body text-center">
                            <h5>Need Help? Call us or drop a message. Our agents will be in touch shortly.</h5>
                            <h2>+91 1234567890</h2>
                            <h3>Or</h3>
                            <a href="mailto:info@yourdomain.com"><i class="fa fa-envelope-o"></i> Email Us</a>
                        </div>
                    </div>
                    <div class="review sidebar-item">
                        <h4><i class="fa fa-comments"></i> Package Reviews</h4>
                        <div class="sidebar-item-body text-center">
                            <div class="rating-box">
                                <div class="col-md-6 col-sm-6 col-xs-6 clear-padding tripadvisor">
                                    <img src="assets/images/tripadvisor.png" alt="cruise"><br>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <h5>4.0/5.0 Based on 12 Reviews</h5>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6 clear-padding">
                                    <i class="fa fa-users"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <h5>Based on 128 Guest Reviews</h5>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="guest-say rating-box">
                                <h2><i class="fa fa-check-circle"></i> Perfect</h2>
                                <div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                                </div>
                                <div class="col-md-5 col-sm-5 col-xs-5 clear-padding user-img">
                                    <img src="assets/images/user1.jpg" alt="cruise">
                                </div>
                                <div class="col-md-7 col-sm-7 col-xs-7 clear-padding user-name">
                                    <span>Lenore, USA</span>
                                    <span>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-o"></i>
										<i class="fa fa-star-o"></i>
									</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: ROOM GALLERY -->

@endsection
