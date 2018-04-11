@extends('layouts.app')

@section('page-title') Hotel Result  @endsection

@section('content')

    <!-- START: PAGE TITLE -->
    <div class="row page-title">
        <div class="container clear-padding text-center">
            <h3>THE GRAND LILLY</h3>
            <h5>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-o"></i>
            </h5>
            <p><i class="fa fa-map-marker"></i> Mall Road, Shimla, Himachal Pradesh, 176077</p>
        </div>
    </div>
    <!-- END: PAGE TITLE -->

    <!-- START: ROOM GALLERY -->
    <div class="row hotel-detail">
        <div class="container">
            <div class="product-brief-info">
                <div class="col-md-8 clear-padding">
                    <div id="slider" class="flexslider">
                        <ul class="slides">
                            <li>
                                <img src="assets/images/slide.jpg" alt="cruise" />
                            </li>
                            <li>
                                <img src="assets/images/slide.jpg" alt="cruise" />
                            </li>
                            <li>
                                <img src="assets/images/slide2.jpg" alt="cruise" />
                            </li>
                            <li>
                                <img src="assets/images/slide.jpg" alt="cruise" />
                            </li>
                            <li>
                                <img src="assets/images/slide.jpg" alt="cruise" />
                            </li>
                            <li>
                                <img src="assets/images/slide2.jpg" alt="cruise" />
                            </li>
                        </ul>
                    </div>
                    <div id="carousel" class="flexslider">
                        <ul class="slides">
                            <li>
                                <img src="assets/images/thumb.jpg" alt="cruise" />
                            </li>
                            <li>
                                <img src="assets/images/thumb.jpg" alt="cruise" />
                            </li>
                            <li>
                                <img src="assets/images/thumb.jpg" alt="cruise" />
                            </li>
                            <li>
                                <img src="assets/images/thumb.jpg" alt="cruise" />
                            </li>
                            <li>
                                <img src="assets/images/thumb.jpg" alt="cruise" />
                            </li>
                            <li>
                                <img src="assets/images/thumb.jpg" alt="cruise" />
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 detail clear-padding">
                    <div class="review sidebar-item">
                        <h4><i class="fa fa-comments"></i> Hotel Reviews</h4>
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
                                    <img src="assets/images/user.jpg" alt="cruise">
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
    <div class="row product-complete-info">
        <div class="container">
            <div class="col-md-8 main-content">
                <div class="room-complete-detail custom-tabs">
                    <ul class="nav nav-tabs">
                        <li class="col-md-2 col-sm-2 col-xs-2 text-center"><a data-toggle="tab" href="#overview"><i class="fa fa-bolt"></i> <span>Overview</span></a></li>
                        <li class="col-md-2 col-sm-2 col-xs-2 active text-center"><a data-toggle="tab" href="#room-info"><i class="fa fa-info-circle"></i> <span>Rooms</span></a></li>
                        <li class="col-md-3 col-sm-3 col-xs-2 text-center"><a data-toggle="tab" href="#ammenties"><i class="fa fa-bed"></i> <span>Ammenties</span></a></li>
                        <li class="col-md-2 col-sm-2 col-xs-2 text-center"><a data-toggle="tab" href="#review"><i class="fa fa-comments"></i> <span>Reviews</span></a></li>
                        <li class="col-md-3 col-sm-3 col-xs-2 text-center"><a data-toggle="tab" href="#write-review"><i class="fa fa-edit"></i> <span>Write Review</span></a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="overview" class="tab-pane fade">
                            <h4 class="tab-heading">About Grand Lilly</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                        </div>
                        <div id="room-info" class="tab-pane fade in active">
                            <h4 class="tab-heading">Room Types</h4>
                            <div class="room-info-wrapper">
                                <div class="col-md-4 col-sm-6 clear-padding">
                                    <img src="assets/images/offer1.jpg" alt="cruise">
                                </div>
                                <div class="col-md-5 col-sm-6 room-desc">
                                    <h4>Deluxe Single Room</h4>
                                    <h5>Max Guest: 2 Adults</h5>
                                    <p>Includes 2 meals - Breakfast & Dinner</p>
                                    <p>
                                        <i class="fa fa-wifi"></i>
                                        <i class="fa fa-taxi"></i>
                                        <i class="fa fa-cutlery"></i>
                                        <i class="fa fa-beer"></i>
                                        <i class="fa fa-coffee"></i>
                                        <i class="fa fa-desktop"></i>
                                    </p>
                                </div>
                                <div class="clearfix visible-sm-block"></div>
                                <div class="col-md-3 text-center booking-box">
                                    <div class="price">
                                        <h3>$199/Night</h3>
                                    </div>
                                    <div class="book">
                                        <a href="#">BOOK</a>
                                    </div>
                                </div>
                            </div>
                            <div class="room-info-wrapper">
                                <div class="col-md-4 col-sm-6 clear-padding">
                                    <img src="assets/images/offer2.jpg" alt="cruise">
                                </div>
                                <div class="col-md-5 col-sm-6 room-desc">
                                    <h4>Deluxe Double Room</h4>
                                    <h5>Max Guest: 4 Adults</h5>
                                    <p>Includes 2 meals - Breakfast & Dinner</p>
                                    <p>
                                        <i class="fa fa-wifi"></i>
                                        <i class="fa fa-taxi"></i>
                                        <i class="fa fa-cutlery"></i>
                                        <i class="fa fa-beer"></i>
                                        <i class="fa fa-coffee"></i>
                                        <i class="fa fa-desktop"></i>
                                    </p>
                                </div>
                                <div class="clearfix visible-sm-block"></div>
                                <div class="col-md-3 text-center booking-box">
                                    <div class="price">
                                        <h3>$299/Night</h3>
                                    </div>
                                    <div class="book">
                                        <a href="#">BOOK</a>
                                    </div>
                                </div>
                            </div>
                            <div class="room-info-wrapper">
                                <div class="col-md-4 col-sm-6 clear-padding">
                                    <img src="assets/images/offer3.jpg" alt="cruise">
                                </div>
                                <div class="col-md-5 col-sm-6 room-desc">
                                    <h4>Royal Suite</h4>
                                    <h5>Max Guest: 2 Adults</h5>
                                    <p>Includes 2 meals - Breakfast & Dinner</p>
                                    <p>
                                        <i class="fa fa-wifi"></i>
                                        <i class="fa fa-taxi"></i>
                                        <i class="fa fa-cutlery"></i>
                                        <i class="fa fa-beer"></i>
                                        <i class="fa fa-coffee"></i>
                                        <i class="fa fa-desktop"></i>
                                    </p>
                                </div>
                                <div class="clearfix visible-sm-block"></div>
                                <div class="col-md-3 text-center booking-box">
                                    <div class="price">
                                        <h3>$399/Night</h3>
                                    </div>
                                    <div class="book">
                                        <a href="#">BOOK</a>
                                    </div>
                                </div>
                            </div>
                            <div class="room-info-wrapper">
                                <div class="col-md-4 col-sm-6 clear-padding">
                                    <img src="assets/images/offer1.jpg" alt="cruise">
                                </div>
                                <div class="col-md-5 col-sm-6 room-desc">
                                    <h4>Royal Suite With Beach View</h4>
                                    <h5>Max Guest: 4 Adults</h5>
                                    <p>Includes 2 meals - Breakfast & Dinner</p>
                                    <p>
                                        <i class="fa fa-wifi"></i>
                                        <i class="fa fa-taxi"></i>
                                        <i class="fa fa-cutlery"></i>
                                        <i class="fa fa-beer"></i>
                                        <i class="fa fa-coffee"></i>
                                        <i class="fa fa-desktop"></i>
                                    </p>
                                </div>
                                <div class="clearfix visible-sm-block"></div>
                                <div class="col-md-3 text-center booking-box">
                                    <div class="price">
                                        <h3>$999/Night</h3>
                                    </div>
                                    <div class="book">
                                        <a href="#">BOOK</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="ammenties" class="tab-pane fade">
                            <h4 class="tab-heading">Ammenties Style 1</h4>
                            <div class="ammenties-1">
                                <div class="col-md-4 col-sm-6">
                                    <p><i class="fa fa-wifi"></i>Free Wifi</p>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <p><i class="fa fa-glass"></i>Free Drinks</p>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <p><i class="fa fa-cutlery"></i>Free Meal</p>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <p><i class="fa fa-taxi"></i>Taxi Available</p>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <p><i class="fa fa-beer"></i>Bar Available</p>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <p><i class="fa fa-desktop"></i>LED</p>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <p><i class="fa fa-coffee"></i>Free Coffee</p>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <p><i class="fa fa-wheelchair"></i>Wheelchair</p>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <p><i class="fa fa-paw"></i>Pet Room</p>
                                </div>
                            </div>
                            <div class="ammenties-3">
                                <h4 class="tab-heading">Ammenties Style 2</h4>
                                <div class="col-md-4 col-xs-6">
                                    <p><i class="fa fa-wifi"></i> Free Wifi</p>
                                </div>
                                <div class="col-md-4 col-xs-6">
                                    <p><i class="fa fa-glass"></i> Free Drinks</p>
                                </div>
                                <div class="col-md-4 col-xs-6">
                                    <p><i class="fa fa-cutlery"></i> Free Meal</p>
                                </div>
                                <div class="col-md-4 col-xs-6">
                                    <p><i class="fa fa-taxi"></i> Taxi Available</p>
                                </div>
                                <div class="col-md-4 col-xs-6">
                                    <p><i class="fa fa-desktop"></i> LED</p>
                                </div>
                                <div class="col-md-4 col-xs-6">
                                    <p><i class="fa fa-beer"></i> Bar Available</p>
                                </div>
                            </div>
                            <div class="ammenties-4">
                                <h4 class="tab-heading">Ammenties Style 3</h4>
                                <div class="col-md-4 col-xs-6">
                                    <p><i class="fa fa-wifi"></i> Free Wifi</p>
                                </div>
                                <div class="col-md-4 col-xs-6">
                                    <p><i class="fa fa-glass"></i> Free Drinks</p>
                                </div>
                                <div class="col-md-4 col-xs-6">
                                    <p><i class="fa fa-cutlery"></i> Free Meal</p>
                                </div>
                                <div class="col-md-4 col-xs-6">
                                    <p><i class="fa fa-taxi"></i> Taxi Available</p>
                                </div>
                                <div class="col-md-4 col-xs-6">
                                    <p><i class="fa fa-desktop"></i> LED</p>
                                </div>
                                <div class="col-md-4 col-xs-6">
                                    <p><i class="fa fa-beer"></i> Bar Available</p>
                                </div>
                            </div>
                            <div class="ammenties-5">
                                <h4 class="tab-heading">Ammenties Style 4</h4>
                                <div class="col-md-4 col-xs-6">
                                    <p><i class="fa fa-check-square-o"></i> Free Wifi</p>
                                </div>
                                <div class="col-md-4 col-xs-6">
                                    <p><i class="fa fa-check-square-o"></i> Free Drinks</p>
                                </div>
                                <div class="col-md-4 col-xs-6">
                                    <p><i class="fa fa-check-square-o"></i> Free Meal</p>
                                </div>
                                <div class="col-md-4 col-xs-6">
                                    <p><i class="fa fa-check-square-o"></i> Taxi Available</p>
                                </div>
                                <div class="col-md-4 col-xs-6">
                                    <p><i class="fa fa-check-square-o"></i> LED</p>
                                </div>
                                <div class="col-md-4 col-xs-6">
                                    <p><i class="fa fa-check-square-o"></i> Bar Available</p>
                                </div>
                            </div>
                            <div class="ammenties-2">
                                <h4 class="tab-heading">Ammenties Style 5</h4>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="ammenties-2-wrapper text-center">
                                        <span>Free Wifi</span>
                                        <i class="fa fa-wifi"></i>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="ammenties-2-wrapper text-center">
                                        <span>Free Meal</span>
                                        <i class="fa fa-cutlery"></i>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="ammenties-2-wrapper text-center">
                                        <span>Free Drinks</span>
                                        <i class="fa fa-glass"></i>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="ammenties-2-wrapper text-center">
                                        <span>Free Coffee</span>
                                        <i class="fa fa-coffee"></i>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="ammenties-2-wrapper text-center">
                                        <span>Free Wifi</span>
                                        <i class="fa fa-wifi"></i>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="ammenties-2-wrapper text-center">
                                        <span>Free Meal</span>
                                        <i class="fa fa-cutlery"></i>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="ammenties-2-wrapper text-center">
                                        <span>Free Drinks</span>
                                        <i class="fa fa-glass"></i>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="ammenties-2-wrapper text-center">
                                        <span>Free Coffee</span>
                                        <i class="fa fa-coffee"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="review" class="tab-pane fade">
                            <div class="review-header">
                                <div class="col-md-6 col-sm6 text-center">
                                    <h2>4.0/5.0</h2>
                                    <h5>Based on 128 Reviews</h5>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <table class="table">
                                        <tr>
                                            <td>Value for Money</td>
                                            <td>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Atmosphere in hotel</td>
                                            <td>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Quality of food</td>
                                            <td>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Staff behaviour</td>
                                            <td>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Restaurant Quality</td>
                                            <td>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="clearfix"></div>
                                <div class="guest-review">
                                    <div class="individual-review dark-review">
                                        <h4>Best Place to Stay, Awesome <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></h4>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                                        <div class="col-md-md-1 col-sm-1 col-xs-2">
                                            <img src="assets/images/user.jpg" alt="cruise">
                                        </div>
                                        <div class="col-md-md-3 col-sm-3 col-xs-3">
                                            <span>Lenore, USA</span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="individual-review">
                                        <h4>Best Place to Stay, Awesome <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></h4>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                                        <div class="col-md-md-1 col-sm-1 col-xs-2">
                                            <img src="assets/images/user.jpg" alt="cruise">
                                        </div>
                                        <div class="col-md-md-3 col-sm-3 col-xs-3">
                                            <span>Lenore, USA</span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="individual-review dark-review">
                                        <h4>Best Place to Stay, Awesome <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></h4>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                                        <div class="col-md-md-1 col-sm-1 col-xs-2">
                                            <img src="assets/images/user.jpg" alt="cruise">
                                        </div>
                                        <div class="col-md-md-3 col-sm-3 col-xs-3">
                                            <span>Lenore, USA</span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="individual-review">
                                        <h4>Best Place to Stay, Awesome <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></h4>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                                        <div class="col-md-md-1 col-sm-1 col-xs-2">
                                            <img src="assets/images/user.jpg" alt="cruise">
                                        </div>
                                        <div class="col-md-md-3 col-sm-3 col-xs-3">
                                            <span>Lenore, USA</span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="individual-review dark-review">
                                        <h4>Best Place to Stay, Awesome <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></h4>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                                        <div class="col-md-md-1 col-sm-1 col-xs-2">
                                            <img src="assets/images/user.jpg" alt="cruise">
                                        </div>
                                        <div class="col-md-md-3 col-sm-3 col-xs-3">
                                            <span>Lenore, USA</span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="load-more text-center">
                                        <a href="#">Load More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="write-review" class="tab-pane fade">
                            <h4 class="tab-heading">Write A Review</h4>
                            <form >
                                <label>Review Title</label>
                                <input type="text" class="form-control" name="review-titile" required>
                                <label for="comment">Comment</label>
                                <textarea class="form-control" rows="5" id="comment"></textarea>
                                <label>Value for Money (Rate out of 5)</label>
                                <input type="text" class="form-control" name="value-for-money">
                                <label>Hotel Atmosphere (Rate out of 5)</label>
                                <input type="text" class="form-control" name="atmosphere">
                                <label>Staff Behaviour (Rate out of 5)</label>
                                <input type="text" class="form-control" name="staff-beh">
                                <label>Food Quality (Rate out of 5)</label>
                                <input type="text" class="form-control" name="food-quality">
                                <label>Rooms (Rate out of 5)</label>
                                <input type="text" class="form-control" name="room">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-default submit-review">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 hotel-detail-sidebar">
                <div class="col-md-12 sidebar-wrapper clear-padding">
                    <div class="map sidebar-item">
                        <h5><i class="fa fa-map-marker"></i> Mall Road, Shimla, Himachal Pradesh, 176077</h5>
                        <iframe class="hotel-map" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJG1usnet4BTkRzQqb_Ys-JOg&amp;key=AIzaSyB6hgZM-ruUqTPVUjXGUR-vv7WRqc4MXjY" ></iframe>
                    </div>
                    <div class="contact sidebar-item">
                        <h4><i class="fa fa-phone"></i> Contact Hotel</h4>
                        <div class="sidebar-item-body">
                            <h5><i class="fa fa-phone"></i> +91 1234567890</h5>
                            <h5><i class="fa fa-envelope-o"></i> <a href="mailto:your@domainname.com">Send Email</a></h5>
                            <h5><i class="fa fa-map-marker"></i> Mall Road, Shimla, Himachal Pradesh, 176077</h5>
                        </div>
                    </div>
                    <div class="similar-hotel sidebar-item">
                        <h4><i class="fa fa-bed"></i> Similar Hotel</h4>
                        <div class="sidebar-item-body">
                            <div class="similar-hotel-box">
                                <a href="#">
                                    <div class="col-md-5 col-sm-5 col-xs-5 clear-padding">
                                        <img src="assets/images/offer1.jpg" alt="Cruise">
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <h5>Royal Resort 3<span><i class="fa fa-star"></i></span></h5>
                                        <h5><i class="fa fa-map-marker"></i> Mall Road, Shimla</h5>
                                        <span>$100/Night</span>
                                    </div>
                                </a>
                            </div>
                            <div class="similar-hotel-box">
                                <a href="#">
                                    <div class="col-md-5 col-sm-5 col-xs-5 clear-padding">
                                        <img src="assets/images/offer2.jpg" alt="Cruise">
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <h5>Royal Resort 5<span><i class="fa fa-star"></i></span></h5>
                                        <h5><i class="fa fa-map-marker"></i> Mall Road, Shimla</h5>
                                        <span>$100/Night</span>
                                    </div>
                                </a>
                            </div>
                            <div class="similar-hotel-box">
                                <a href="#">
                                    <div class="col-md-5 col-sm-5 col-xs-5 clear-padding">
                                        <img src="assets/images/offer3.jpg" alt="Cruise">
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <h5>Royal Resort 4<span><i class="fa fa-star"></i></span></h5>
                                        <h5><i class="fa fa-map-marker"></i> Mall Road, Shimla</h5>
                                        <span>$100/Night</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: ROOM GALLERY -->

@endsection

@section('javascript')
    <script type="text/javascript">
        $(window).load(function() {
            "use strict";
            // The slider being synced must be initialized first
            $('#carousel').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                itemWidth: 150,
                itemMargin: 5,
                asNavFor: '#slider'
            });

            $('#slider').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                sync: "#carousel"
            });
        });
    </script>
@endsection

@section('css')

@endsection