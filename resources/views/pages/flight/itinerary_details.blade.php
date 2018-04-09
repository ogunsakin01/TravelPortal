<div class="row modify-search modify-flight">
    <div class="container clear-padding">
        <form >
            <div class="col-md-2 col-sm-6">
                <div class="form-gp">
                    <label>Leaving From</label>
                    <div class="input-group margin-bottom-sm">
                        <input type="text" name="departure_city" class="form-control" required placeholder="E.g. London">
                        <span class="input-group-addon"><i class="fa fa-map-marker fa-fw"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-6">
                <div class="form-gp">
                    <label>Leaving To</label>
                    <div class="input-group margin-bottom-sm">
                        <input type="text" name="destination_city" class="form-control" required placeholder="E.g. New York">
                        <span class="input-group-addon"><i class="fa fa-map-marker fa-fw"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-6 col-xs-6">
                <div class="form-gp">
                    <label>Departure</label>
                    <div class="input-group margin-bottom-sm">
                        <input type="text" id="departure_date" name="departure_date" class="form-control" required placeholder="DD/MM/YYYY">
                        <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-6 col-xs-6">
                <div class="form-gp">
                    <label>Return</label>
                    <div class="input-group margin-bottom-sm">
                        <input type="text" id="return_date" name="return_date" class="form-control" required placeholder="DD/MM/YYYY">
                        <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-1 col-sm-6 col-xs-3">
                <div class="form-gp">
                    <label>Adult</label>
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
            <div class="col-md-1 col-sm-6 col-xs-3">
                <div class="form-gp">
                    <label>Child</label>
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
            <div class="col-md-2 col-sm-6 col-xs-6">
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
                    <h5><i class="fa fa-plane"></i> Airline Name</h5>
                    <div class="input-group margin-bottom-sm">
                        <input type="text" name="airline_name" class="form-control" required placeholder="E.g. Vistara">
                        <span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span>
                    </div>
                </div>
                <div class="airline-filter filter">
                    <h5><i class="fa fa-plane"></i> Airline</h5>
                    <ul>
                        <li><input type="checkbox"><img src="assets/images/airline/airline.jpg" alt="cruise"> Vistara</li>
                        <li><input type="checkbox"><img src="assets/images/airline/airline.jpg" alt="cruise"> Indigo</li>
                        <li><input type="checkbox"><img src="assets/images/airline/airline.jpg" alt="cruise"> Spicejet</li>
                        <li><input type="checkbox"><img src="assets/images/airline/airline.jpg" alt="cruise"> Jet</li>
                        <li><input type="checkbox"><img src="assets/images/airline/airline.jpg" alt="cruise"> Vistara</li>
                        <li><input type="checkbox"><img src="assets/images/airline/airline.jpg" alt="cruise"> Indigo</li>
                    </ul>
                </div>
                <div class="stop-filter filter">
                    <h5><i class="fa fa-stop"></i> Stops</h5>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary">
                            <input type="radio" name="options" id="option1"> 0 <br>Stop
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="options" id="option2"> 1 <br>Stops
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="options" id="option3"> 1+ <br>Stops
                        </label>
                    </div>
                </div>
                <div class="filter">
                    <h5><i class="fa fa-list"></i> Class</h5>
                    <ul>
                        <li><input type="checkbox"> Economy</li>
                        <li><input type="checkbox"> Business</li>
                        <li><input type="checkbox"> All</li>
                    </ul>
                </div>
                <div class="facilities-filter filter">
                    <h5><i class="fa fa-list"></i> Airline Facilities</h5>
                    <ul>
                        <li><input type="checkbox"> <i class="fa fa-wifi"></i> Wifi</li>
                        <li><input type="checkbox"> <i class="fa fa-cab"></i> Taxi</li>
                        <li><input type="checkbox"> <i class="fa fa-cutlery"></i> Meal</li>
                        <li><input type="checkbox"> <i class="fa fa-coffee"></i> Coffee </li>
                        <li><input type="checkbox"> <i class="fa fa-cutlery"></i> Meal</li>
                        <li><input type="checkbox"> <i class="fa fa-coffee"></i> Coffee</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END: FILTER AREA -->

        <!-- START: INDIVIDUAL LISTING AREA -->
        <div class="col-md-9 flight-listing">

            <!-- START: LOWEST FARE SLIDER -->
            <div class="lowest-fare-slider col-md-12">
                <div class="owl-carousel" id="lowest-fare">
                    <div class="text-center">
                        <h5>22 Aug</h5>
                        <span>From $129</span>
                    </div>
                    <div class="text-center">
                        <h5>23 Aug</h5>
                        <span>From $119</span>
                    </div>
                    <div class="text-center">
                        <h5>24 Aug</h5>
                        <span>From $299</span>
                    </div>
                    <div class="text-center">
                        <h5>25 Aug</h5>
                        <span>From $200</span>
                    </div>
                    <div class="text-center">
                        <h5>26 Aug</h5>
                        <span>From $150</span>
                    </div>
                    <div class="text-center">
                        <h5>27 Aug</h5>
                        <span>From $300</span>
                    </div>
                    <div class="text-center">
                        <h5>28 Aug</h5>
                        <span>From $400</span>
                    </div>
                    <div class="text-center">
                        <h5>29 Aug</h5>
                        <span>From $500</span>
                    </div>
                </div>
            </div>
            <!-- END: LOWEST FARE SLIDER -->

            <!-- START: SORT AREA -->
            <div class="sort-area col-md-12">
                <div class="col-md-3 col-sm-3 col-xs-6 sort">
                    <select class="selectpicker">
                        <option>Price</option>
                        <option> Low to High</option>
                        <option> High to Low</option>
                    </select>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6 sort">
                    <select class="selectpicker">
                        <option>Airline</option>
                        <option> Vistara</option>
                        <option> Indigo</option>
                        <option> Jet</option>
                        <option> Spicejet</option>
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
            <div class="clearfix"></div>
            <!-- START: FLIGHT LIST VIEW -->
            <div class="flight-list-v2">
                <div class="flight-list-main">
                    <div class="col-md-2 col-sm-2 text-center airline">
                        <img src="assets/images/airline/airline.jpg" alt="cruise">
                        <h6>Vistara</h6>
                    </div>
                    <div class="col-md-3 col-sm-3 departure">
                        <h3><i class="fa fa-plane"></i> LHR 19:00</h3>
                        <h5 class="bold">SAT, 21 SEP</h5>
                        <h5>London, UK</h5>
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
                            <span><i class="fa fa-clock-o"></i> 02h 00m</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 destination">
                        <h3><i class="fa fa-plane fa-rotate-90"></i> DEL 21:00</h3>
                        <h5 class="bold">SAT, 21 SEP</h5>
                        <h5>New Delhi, IN</h5>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="flight-list-footer">
                    <div class="col-md-6 col-sm-6 col-xs-6 sm-invisible">
                        <span><i class="fa fa-plane"></i> Economy</span>
                        <span class="refund"><i class="fa fa-undo"></i> Refundable</span>
                        <span><i class="fa fa-suitcase"></i> 10 KG</span>
                        <span data-toggle="modal" data-target=".flight-details"><i class="fa fa-info-circle"></i></span>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 clear-padding">
                        <div class="pull-right">
                            <span>$199/Person</span>
                            <a href="#">BOOK</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flight-list-v2">
                <div class="flight-list-main">
                    <div class="col-md-2 col-sm-2 text-center airline">
                        <img src="assets/images/airline/airline.jpg" alt="cruise">
                        <h6>Spicejet</h6>
                    </div>
                    <div class="col-md-3 col-sm-3 departure">
                        <h3><i class="fa fa-plane"></i> JFK 11:00</h3>
                        <h5 class="bold">SAT, 21 SEP</h5>
                        <h5>New York, USA</h5>
                    </div>
                    <div class="col-md-4 col-sm-4 stop-duration">
                        <div class="flight-direction">
                        </div>
                        <div class="stop">
                        </div>
                        <div class="stop-box">
                            <span>1 Stop</span>
                        </div>
                        <div class="duration text-center">
                            <span><i class="fa fa-clock-o"></i> 01h 00m</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 destination">
                        <h3><i class="fa fa-plane fa-rotate-90"></i> DEL 12:00</h3>
                        <h5 class="bold">SAT, 21 SEP</h5>
                        <h5>Los Angeles, USA</h5>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="flight-list-footer">
                    <div class="col-md-6 col-sm-6 col-xs-6 sm-invisible">
                        <span><i class="fa fa-plane"></i> Economy</span>
                        <span class="refund"><i class="fa fa-undo"></i> Refundable</span>
                        <span><i class="fa fa-suitcase"></i> 10 KG</span>
                        <span data-toggle="modal" data-target=".flight-details"><i class="fa fa-info-circle"></i></span>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 clear-padding">
                        <div class="pull-right">
                            <span>$199/Person</span>
                            <a href="#">BOOK</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flight-list-v2">
                <div class="flight-list-main">
                    <div class="col-md-2 col-sm-2 text-center airline">
                        <img src="assets/images/airline/airline.jpg" alt="cruise">
                        <h6>Indigo</h6>
                    </div>
                    <div class="col-md-3 col-sm-3 departure">
                        <h3><i class="fa fa-plane"></i> JFK 11:00</h3>
                        <h5 class="bold">SAT, 21 SEP</h5>
                        <h5>New York, USA</h5>
                    </div>
                    <div class="col-md-4 col-sm-4 stop-duration">
                        <div class="flight-direction">
                        </div>
                        <div class="stop">
                        </div>
                        <div class="stop-box">
                            <span>1 Stop</span>
                        </div>
                        <div class="duration text-center">
                            <span><i class="fa fa-clock-o"></i> 01h 00m</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 destination">
                        <h3><i class="fa fa-plane fa-rotate-90"></i> DEL 12:00</h3>
                        <h5 class="bold">SAT, 21 SEP</h5>
                        <h5>Los Angeles, USA</h5>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="flight-list-footer">
                    <div class="col-md-6 col-sm-6 col-xs-6 sm-invisible">
                        <span><i class="fa fa-plane"></i> Economy</span>
                        <span class="refund"><i class="fa fa-undo"></i> Refundable</span>
                        <span><i class="fa fa-suitcase"></i> 10 KG</span>
                        <span data-toggle="modal" data-target=".flight-details"><i class="fa fa-info-circle"></i></span>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 clear-padding">
                        <div class="pull-right">
                            <span>$299/Person</span>
                            <a href="#">BOOK</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flight-list-v2">
                <div class="flight-list-main">
                    <div class="col-md-2 col-sm-2 text-center airline">
                        <img src="assets/images/airline/airline.jpg" alt="cruise">
                        <h6>Vistara</h6>
                    </div>
                    <div class="col-md-3 col-sm-3 departure">
                        <h3><i class="fa fa-plane"></i> LHR 19:00</h3>
                        <h5 class="bold">SAT, 21 SEP</h5>
                        <h5>London, UK</h5>
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
                            <span><i class="fa fa-clock-o"></i> 02h 00m</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 destination">
                        <h3><i class="fa fa-plane fa-rotate-90"></i> DEL 21:00</h3>
                        <h5 class="bold">SAT, 21 SEP</h5>
                        <h5>New Delhi, IN</h5>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="flight-list-footer">
                    <div class="col-md-6 col-sm-6 col-xs-6 sm-invisible">
                        <span><i class="fa fa-plane"></i> Economy</span>
                        <span class="refund"><i class="fa fa-undo"></i> Refundable</span>
                        <span><i class="fa fa-suitcase"></i> 10 KG</span>
                        <span data-toggle="modal" data-target=".flight-details"><i class="fa fa-info-circle"></i></span>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 clear-padding">
                        <div class="pull-right">
                            <span>$199/Person</span>
                            <a href="#">BOOK</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flight-list-v2">
                <div class="flight-list-main">
                    <div class="col-md-2 col-sm-2 text-center airline">
                        <img src="assets/images/airline/airline.jpg" alt="cruise">
                        <h6>Spicejet</h6>
                    </div>
                    <div class="col-md-3 col-sm-3 departure">
                        <h3><i class="fa fa-plane"></i> JFK 11:00</h3>
                        <h5 class="bold">SAT, 21 SEP</h5>
                        <h5>New York, USA</h5>
                    </div>
                    <div class="col-md-4 col-sm-4 stop-duration">
                        <div class="flight-direction">
                        </div>
                        <div class="stop">
                        </div>
                        <div class="stop-box">
                            <span>1 Stop</span>
                        </div>
                        <div class="duration text-center">
                            <span><i class="fa fa-clock-o"></i> 01h 00m</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 destination">
                        <h3><i class="fa fa-plane fa-rotate-90"></i> DEL 12:00</h3>
                        <h5 class="bold">SAT, 21 SEP</h5>
                        <h5>Los Angeles, USA</h5>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="flight-list-footer">
                    <div class="col-md-6 col-sm-6 col-xs-6 sm-invisible">
                        <span><i class="fa fa-plane"></i> Economy</span>
                        <span class="refund"><i class="fa fa-undo"></i> Refundable</span>
                        <span><i class="fa fa-suitcase"></i> 10 KG</span>
                        <span data-toggle="modal" data-target=".flight-details"><i class="fa fa-info-circle"></i></span>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 clear-padding">
                        <div class="pull-right">
                            <span>$199/Person</span>
                            <a href="#">BOOK</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flight-list-v2">
                <div class="flight-list-main">
                    <div class="col-md-2 col-sm-2 text-center airline">
                        <img src="assets/images/airline/airline.jpg" alt="cruise">
                        <h6>Indigo</h6>
                    </div>
                    <div class="col-md-3 col-sm-3 departure">
                        <h3><i class="fa fa-plane"></i> JFK 11:00</h3>
                        <h5 class="bold">SAT, 21 SEP</h5>
                        <h5>New York, USA</h5>
                    </div>
                    <div class="col-md-4 col-sm-4 stop-duration">
                        <div class="flight-direction">
                        </div>
                        <div class="stop">
                        </div>
                        <div class="stop-box">
                            <span>1 Stop</span>
                        </div>
                        <div class="duration text-center">
                            <span><i class="fa fa-clock-o"></i> 01h 00m</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 destination">
                        <h3><i class="fa fa-plane fa-rotate-90"></i> DEL 12:00</h3>
                        <h5 class="bold">SAT, 21 SEP</h5>
                        <h5>Los Angeles, USA</h5>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="flight-list-footer">
                    <div class="col-md-6 col-sm-6 col-xs-6 sm-invisible">
                        <span><i class="fa fa-plane"></i> Economy</span>
                        <span class="refund"><i class="fa fa-undo"></i> Refundable</span>
                        <span><i class="fa fa-suitcase"></i> 10 KG</span>
                        <span data-toggle="modal" data-target=".flight-details"><i class="fa fa-info-circle"></i></span>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 clear-padding">
                        <div class="pull-right">
                            <span>$299/Person</span>
                            <a href="#">BOOK</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <!-- END: FLIGHT LIST VIEW -->

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