@extends('layouts.app')

@section('page-title') Hotel Result  @endsection

@section('content')

    <!-- START: MODIFY SEARCH -->
    <div class="row modify-search modify-hotel">
        <div class="container clear-padding">
            <form >
                <div class="col-md-4">
                    <div class="form-gp">
                        <label>Location</label>
                        <div class="input-group margin-bottom-sm">
                            <input type="text" name="city" class="form-control" required placeholder="E.g. London">
                            <span class="input-group-addon"><i class="fa fa-map-marker fa-fw"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-6">
                    <div class="form-gp">
                        <label>Check In</label>
                        <div class="input-group margin-bottom-sm">
                            <input type="text" id="check_in" name="check_in" class="form-control" placeholder="DD/MM/YYYY">
                            <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-6">
                    <div class="form-gp">
                        <label>Check Out</label>
                        <div class="input-group margin-bottom-sm">
                            <input type="text" id="check_out" name="check_out" class="form-control" required placeholder="DD/MM/YYYY">
                            <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 col-sm-6 col-xs-3">
                    <div class="form-gp">
                        <label>Rooms</label>
                        <select class="selectpicker">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-9">
                    <div class="form-gp">
                        <button type="submit" class="modify-search-button btn transition-effect">MODIFY SEARCH</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END: MODIFY SEARCH -->

    <!-- START: LISTING AREA-->
    <div class="row">
        <div class="container">
            <!-- START: FILTER AREA -->
            <div class="col-md-3 clear-padding">
                <div class="filter-head text-center">
                    <h4>25 Result Found Matching Your Search.</h4>
                </div>
                <div class="filter-area">
                    <div class="price-filter filter">
                        <h5><i class="fa fa-usd"></i> Price</h5>
                        <p>
                            <label></label>
                            <input type="text" id="amount" readonly>
                        </p>
                        <div id="price-range"></div>
                    </div>
                    <div class="name-filter filter">
                        <h5><i class="fa fa-bed"></i> Hotel Name</h5>
                        <div class="input-group margin-bottom-sm">
                            <input type="text" name="destination_city" class="form-control" required placeholder="E.g. Shimla">
                            <span class="input-group-addon"><i class="fa fa-map-marker fa-fw"></i></span>
                        </div>
                    </div>
                    <div class="star-filter filter">
                        <h5><i class="fa fa-star"></i> Star</h5>
                        <ul>
                            <li><input type="checkbox"> <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></li>
                            <li><input type="checkbox"> <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></li>
                            <li><input type="checkbox"> <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></li>
                            <li><input type="checkbox"> <i class="fa fa-star"></i><i class="fa fa-star"></i></li>
                            <li><input type="checkbox"> <i class="fa fa-star"></i></li>
                            <li><input type="checkbox"> <i class="fa fa-star"></i> Any</li>
                        </ul>
                    </div>
                    <div class="location-filter filter">
                        <h5><i class="fa fa-map-marker"></i> Location</h5>
                        <ul>
                            <li><input type="checkbox"> Sanjoli</li>
                            <li><input type="checkbox"> Shimla</li>
                            <li><input type="checkbox"> Mall Road</li>
                            <li><input type="checkbox"> New Shimla</li>
                            <li><input type="checkbox"> Summer Hill</li>
                            <li><input type="checkbox"> Shimla</li>
                        </ul>
                    </div>
                    <div class="facilities-filter filter">
                        <h5><i class="fa fa-list"></i> Hotel Facilities</h5>
                        <ul>
                            <li><input type="checkbox"> <i class="fa fa-wifi"></i> Wifi</li>
                            <li><input type="checkbox"> <i class="fa fa-beer"></i> Bar</li>
                            <li><input type="checkbox"> <i class="fa fa-cutlery"></i> Restaurant</li>
                            <li><input type="checkbox"> <i class="fa fa-coffee"></i> Coffee</li>
                            <li><input type="checkbox"> <i class="fa fa-wifi"></i> Wifi</li>
                            <li><input type="checkbox"> <i class="fa fa-beer"></i> Bar</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- END: FILTER AREA -->

            <!-- START: INDIVIDUAL LISTING AREA -->
            <div class="col-md-9 hotel-listing text-center">

                <!-- START: SORT AREA -->
                <div class="sort-area col-sm-10">
                    <div class="col-md-3 col-sm-3 col-xs-6 sort">
                        <select class="selectpicker">
                            <option>Price</option>
                            <option> Low to High</option>
                            <option> High to Low</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6 sort">
                        <select class="selectpicker">
                            <option>Star Rating</option>
                            <option> Low to High</option>
                            <option> High to Low</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6 sort">
                        <select class="selectpicker">
                            <option>User Rating</option>
                            <option> Low to High</option>
                            <option> High to Low</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6 sort">
                        <select class="selectpicker">
                            <option>Name</option>
                            <option> Ascending</option>
                            <option> Descending</option>
                        </select>
                    </div>
                </div>
                <!-- END: SORT AREA -->
                <div class="clearfix visible-xs-block"></div>
                <div class="col-sm-2 view-switcher">
                    <div class="pull-right">
                        <a href="#" title="Grid View">
                            <i class="fa fa-th-large"></i>
                        </a>
                        <a href="hotel-list.html" title="List View">
                            <i class="fa fa-list"></i>
                        </a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <!-- START: HOTEL GRID VIEW -->
                <div class="col-md-4 col-sm-6">
                    <div class="room-grid-view">
                        <img src="assets/images/offer1.jpg" alt="cruise">
                        <div class="room-info">
                            <div class="room-title">
                                <h5>Devlok Hotel<span> 3<i class="fa fa-star"></i></span></h5>
                                <p><i class="fa fa-map-marker"></i> Main Road, Manali</p>
                                <div class="hotel-ammeties">
                                    <i class="fa fa-wifi" title="Free Wifi"></i>
                                    <i class="fa fa-cutlery" title="Breakfast"></i>
                                    <i class="fa fa-taxi" title="Taxi Available"></i>
                                    <i class="fa fa-bed" title="Extra Bed"></i>
                                    <i class="fa fa-coffee" title="Free Drinks"></i>
                                    <i class="fa fa-beer" title="Bar"></i>
                                </div>
                            </div>
                            <div class="room-desc">
                                <p>Lorem Ipsum is simply dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                            <div class="hotel-rating">
                                <div class="pull-left">
                                    <img src="assets/images/tripadvisor.png" alt="cruise"><span>4.5/5</span>
                                </div>
                                <div class="pull-right">
                                    <i class="fa fa-star colored"></i><i class="fa fa-star colored"></i><i class="fa fa-star colored"></i><i class="fa fa-star colored"></i><i class="fa fa-star"></i><br>
                                    <span>128 Guest Reviews</span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="room-book">
                                <div class="col-md-8 col-sm-6 col-xs-6 clear-padding">
                                    <h5>$49 Avg/Night</h5>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-6 clear-padding">
                                    <a href="#">Book</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="room-grid-view">
                        <img src="assets/images/offer2.jpg" alt="cruise">
                        <div class="room-info">
                            <div class="room-title">
                                <h5>Devlok Hotel<span> 3<i class="fa fa-star"></i></span></h5>
                                <p><i class="fa fa-map-marker"></i> Main Road, Manali</p>
                                <div class="hotel-ammeties">
                                    <i class="fa fa-wifi" title="Free Wifi"></i>
                                    <i class="fa fa-cutlery" title="Breakfast"></i>
                                    <i class="fa fa-taxi" title="Taxi Available"></i>
                                    <i class="fa fa-bed" title="Extra Bed"></i>
                                    <i class="fa fa-coffee" title="Free Drinks"></i>
                                    <i class="fa fa-beer" title="Bar"></i>
                                </div>
                            </div>
                            <div class="room-desc">
                                <p>Lorem Ipsum is simply dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                            <div class="hotel-rating">
                                <div class="pull-left">
                                    <img src="assets/images/tripadvisor.png" alt="cruise"><span>4.5/5</span>
                                </div>
                                <div class="pull-right">
                                    <i class="fa fa-star colored"></i><i class="fa fa-star colored"></i><i class="fa fa-star colored"></i><i class="fa fa-star colored"></i><i class="fa fa-star"></i><br>
                                    <span>128 Guest Reviews</span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="room-book">
                                <div class="col-md-8 col-sm-6 col-xs-6 clear-padding">
                                    <h5>$49 Avg/Night</h5>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-6 clear-padding">
                                    <a href="#">Book</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix-sm"></div>
                <div class="col-md-4 col-sm-6">
                    <div class="room-grid-view">
                        <img src="assets/images/offer3.jpg" alt="cruise">
                        <div class="room-info">
                            <div class="room-title">
                                <h5>Devlok Hotel<span> 3<i class="fa fa-star"></i></span></h5>
                                <p><i class="fa fa-map-marker"></i> Main Road, Manali</p>
                                <div class="hotel-ammeties">
                                    <i class="fa fa-wifi" title="Free Wifi"></i>
                                    <i class="fa fa-cutlery" title="Breakfast"></i>
                                    <i class="fa fa-taxi" title="Taxi Available"></i>
                                    <i class="fa fa-bed" title="Extra Bed"></i>
                                    <i class="fa fa-coffee" title="Free Drinks"></i>
                                    <i class="fa fa-beer" title="Bar"></i>
                                </div>
                            </div>
                            <div class="room-desc">
                                <p>Lorem Ipsum is simply dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                            <div class="hotel-rating">
                                <div class="pull-left">
                                    <img src="assets/images/tripadvisor.png" alt="cruise"><span>4.5/5</span>
                                </div>
                                <div class="pull-right">
                                    <i class="fa fa-star colored"></i><i class="fa fa-star colored"></i><i class="fa fa-star colored"></i><i class="fa fa-star colored"></i><i class="fa fa-star"></i><br>
                                    <span>128 Guest Reviews</span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="room-book">
                                <div class="col-md-8 col-sm-6 col-xs-6 clear-padding">
                                    <h5>$49 Avg/Night</h5>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-6 clear-padding">
                                    <a href="#">Book</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix-md"></div>
                <div class="col-md-4 col-sm-6">
                    <div class="room-grid-view">
                        <img src="assets/images/offer1.jpg" alt="cruise">
                        <div class="room-info">
                            <div class="room-title">
                                <h5>Devlok Hotel<span> 3<i class="fa fa-star"></i></span></h5>
                                <p><i class="fa fa-map-marker"></i> Main Road, Manali</p>
                                <div class="hotel-ammeties">
                                    <i class="fa fa-wifi" title="Free Wifi"></i>
                                    <i class="fa fa-cutlery" title="Breakfast"></i>
                                    <i class="fa fa-taxi" title="Taxi Available"></i>
                                    <i class="fa fa-bed" title="Extra Bed"></i>
                                    <i class="fa fa-coffee" title="Free Drinks"></i>
                                    <i class="fa fa-beer" title="Bar"></i>
                                </div>
                            </div>
                            <div class="room-desc">
                                <p>Lorem Ipsum is simply dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                            <div class="hotel-rating">
                                <div class="pull-left">
                                    <img src="assets/images/tripadvisor.png" alt="cruise"><span>4.5/5</span>
                                </div>
                                <div class="pull-right">
                                    <i class="fa fa-star colored"></i><i class="fa fa-star colored"></i><i class="fa fa-star colored"></i><i class="fa fa-star colored"></i><i class="fa fa-star"></i><br>
                                    <span>128 Guest Reviews</span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="room-book">
                                <div class="col-md-8 col-sm-6 col-xs-6 clear-padding">
                                    <h5>$49 Avg/Night</h5>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-6 clear-padding">
                                    <a href="#">Book</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix-sm"></div>
                <div class="col-md-4 col-sm-6">
                    <div class="room-grid-view">
                        <img src="assets/images/offer2.jpg" alt="cruise">
                        <div class="room-info">
                            <div class="room-title">
                                <h5>Devlok Hotel<span> 3<i class="fa fa-star"></i></span></h5>
                                <p><i class="fa fa-map-marker"></i> Main Road, Manali</p>
                                <div class="hotel-ammeties">
                                    <i class="fa fa-wifi" title="Free Wifi"></i>
                                    <i class="fa fa-cutlery" title="Breakfast"></i>
                                    <i class="fa fa-taxi" title="Taxi Available"></i>
                                    <i class="fa fa-bed" title="Extra Bed"></i>
                                    <i class="fa fa-coffee" title="Free Drinks"></i>
                                    <i class="fa fa-beer" title="Bar"></i>
                                </div>
                            </div>
                            <div class="room-desc">
                                <p>Lorem Ipsum is simply dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                            <div class="hotel-rating">
                                <div class="pull-left">
                                    <img src="assets/images/tripadvisor.png" alt="cruise"><span>4.5/5</span>
                                </div>
                                <div class="pull-right">
                                    <i class="fa fa-star colored"></i><i class="fa fa-star colored"></i><i class="fa fa-star colored"></i><i class="fa fa-star colored"></i><i class="fa fa-star"></i><br>
                                    <span>128 Guest Reviews</span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="room-book">
                                <div class="col-md-8 col-sm-6 col-xs-6 clear-padding">
                                    <h5>$49 Avg/Night</h5>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-6 clear-padding">
                                    <a href="#">Book</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="room-grid-view">
                        <img src="assets/images/offer3.jpg" alt="cruise">
                        <div class="room-info">
                            <div class="room-title">
                                <h5>Devlok Hotel<span> 3<i class="fa fa-star"></i></span></h5>
                                <p><i class="fa fa-map-marker"></i> Main Road, Manali</p>
                                <div class="hotel-ammeties">
                                    <i class="fa fa-wifi" title="Free Wifi"></i>
                                    <i class="fa fa-cutlery" title="Breakfast"></i>
                                    <i class="fa fa-taxi" title="Taxi Available"></i>
                                    <i class="fa fa-bed" title="Extra Bed"></i>
                                    <i class="fa fa-coffee" title="Free Drinks"></i>
                                    <i class="fa fa-beer" title="Bar"></i>
                                </div>
                            </div>
                            <div class="room-desc">
                                <p>Lorem Ipsum is simply dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                            <div class="hotel-rating">
                                <div class="pull-left">
                                    <img src="assets/images/tripadvisor.png" alt="cruise"><span>4.5/5</span>
                                </div>
                                <div class="pull-right">
                                    <i class="fa fa-star colored"></i><i class="fa fa-star colored"></i><i class="fa fa-star colored"></i><i class="fa fa-star colored"></i><i class="fa fa-star"></i><br>
                                    <span>128 Guest Reviews</span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="room-book">
                                <div class="col-md-8 col-sm-6 col-xs-6 clear-padding">
                                    <h5>$49 Avg/Night</h5>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-6 clear-padding">
                                    <a href="#">Book</a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="clearfix-md clearfix-sm"></div>
                <div class="col-md-4 col-sm-6">
                    <div class="room-grid-view">
                        <img src="assets/images/offer1.jpg" alt="cruise">
                        <div class="room-info">
                            <div class="room-title">
                                <h5>Devlok Hotel<span> 3<i class="fa fa-star"></i></span></h5>
                                <p><i class="fa fa-map-marker"></i> Main Road, Manali</p>
                                <div class="hotel-ammeties">
                                    <i class="fa fa-wifi" title="Free Wifi"></i>
                                    <i class="fa fa-cutlery" title="Breakfast"></i>
                                    <i class="fa fa-taxi" title="Taxi Available"></i>
                                    <i class="fa fa-bed" title="Extra Bed"></i>
                                    <i class="fa fa-coffee" title="Free Drinks"></i>
                                    <i class="fa fa-beer" title="Bar"></i>
                                </div>
                            </div>
                            <div class="room-desc">
                                <p>Lorem Ipsum is simply dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                            <div class="hotel-rating">
                                <div class="pull-left">
                                    <img src="assets/images/tripadvisor.png" alt="cruise"><span>4.5/5</span>
                                </div>
                                <div class="pull-right">
                                    <i class="fa fa-star colored"></i><i class="fa fa-star colored"></i><i class="fa fa-star colored"></i><i class="fa fa-star colored"></i><i class="fa fa-star"></i><br>
                                    <span>128 Guest Reviews</span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="room-book">
                                <div class="col-md-8 col-sm-6 col-xs-6 clear-padding">
                                    <h5>$49 Avg/Night</h5>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-6 clear-padding">
                                    <a href="#">Book</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="room-grid-view">
                        <img src="assets/images/offer2.jpg" alt="cruise">
                        <div class="room-info">
                            <div class="room-title">
                                <h5>Devlok Hotel<span> 3<i class="fa fa-star"></i></span></h5>
                                <p><i class="fa fa-map-marker"></i> Main Road, Manali</p>
                                <div class="hotel-ammeties">
                                    <i class="fa fa-wifi" title="Free Wifi"></i>
                                    <i class="fa fa-cutlery" title="Breakfast"></i>
                                    <i class="fa fa-taxi" title="Taxi Available"></i>
                                    <i class="fa fa-bed" title="Extra Bed"></i>
                                    <i class="fa fa-coffee" title="Free Drinks"></i>
                                    <i class="fa fa-beer" title="Bar"></i>
                                </div>
                            </div>
                            <div class="room-desc">
                                <p>Lorem Ipsum is simply dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                            <div class="hotel-rating">
                                <div class="pull-left">
                                    <img src="assets/images/tripadvisor.png" alt="cruise"><span>4.5/5</span>
                                </div>
                                <div class="pull-right">
                                    <i class="fa fa-star colored"></i><i class="fa fa-star colored"></i><i class="fa fa-star colored"></i><i class="fa fa-star colored"></i><i class="fa fa-star"></i><br>
                                    <span>128 Guest Reviews</span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="room-book">
                                <div class="col-md-8 col-sm-6 col-xs-6 clear-padding">
                                    <h5>$49 Avg/Night</h5>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-6 clear-padding">
                                    <a href="#">Book</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix-sm"></div>
                <div class="col-md-4 col-sm-6">
                    <div class="room-grid-view">
                        <img src="assets/images/offer3.jpg" alt="cruise">
                        <div class="room-info">
                            <div class="room-title">
                                <h5>Devlok Hotel<span> 3<i class="fa fa-star"></i></span></h5>
                                <p><i class="fa fa-map-marker"></i> Main Road, Manali</p>
                                <div class="hotel-ammeties">
                                    <i class="fa fa-wifi" title="Free Wifi"></i>
                                    <i class="fa fa-cutlery" title="Breakfast"></i>
                                    <i class="fa fa-taxi" title="Taxi Available"></i>
                                    <i class="fa fa-bed" title="Extra Bed"></i>
                                    <i class="fa fa-coffee" title="Free Drinks"></i>
                                    <i class="fa fa-beer" title="Bar"></i>
                                </div>
                            </div>
                            <div class="room-desc">
                                <p>Lorem Ipsum is simply dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                            <div class="hotel-rating">
                                <div class="pull-left">
                                    <img src="assets/images/tripadvisor.png" alt="cruise"><span>4.5/5</span>
                                </div>
                                <div class="pull-right">
                                    <i class="fa fa-star colored"></i><i class="fa fa-star colored"></i><i class="fa fa-star colored"></i><i class="fa fa-star colored"></i><i class="fa fa-star"></i><br>
                                    <span>128 Guest Reviews</span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="room-book">
                                <div class="col-md-8 col-sm-6 col-xs-6 clear-padding">
                                    <h5>$49 Avg/Night</h5>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-6 clear-padding">
                                    <a href="#">Book</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <!-- END: HOTEL GRID VIEW -->

                <!-- START: PAGINATION -->
                <div class="bottom-pagination">
                    <nav class="pull-right">
                        <ul class="pagination pagination-lg">
                            <li><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                            <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                            <li><a href="#">2 <span class="sr-only">(current)</span></a></li>
                            <li><a href="#">3 <span class="sr-only">(current)</span></a></li>
                            <li><a href="#">4 <span class="sr-only">(current)</span></a></li>
                            <li><a href="#">5 <span class="sr-only">(current)</span></a></li>
                            <li><a href="#">6 <span class="sr-only">(current)</span></a></li>
                            <li><a href="#" aria-label="Previous"><span aria-hidden="true">&#187;</span></a></li>
                        </ul>
                    </nav>
                </div>
                <!-- END: PAGINATION -->
            </div>
            <!-- END: INDIVIDUAL LISTING AREA -->
        </div>
    </div>
    <!-- END: LISTING AREA -->

@endsection

@section('javascript')
    <script type="text/javascript">
        /* Price Range Slider */

        $(function() {
            "use strict";
            $( "#price-range" ).slider({
                range: true,
                min: 0,
                max: 100,
                values: [ 3, 50 ],
                slide: function( event, ui ) {
                    $( "#amount" ).val( "$ " + ui.values[ 0 ] + " - $ " + ui.values[ 1 ] );
                }
            });
            $( "#amount" ).val( "$ " + $( "#price-range" ).slider( "values", 0 ) +
                " - $ " + $( "#price-range" ).slider( "values", 1 ) );
        });
    </script>
@endsection

@section('css')

@endsection