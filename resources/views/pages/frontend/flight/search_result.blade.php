@extends('layouts.app')

@section('page-title') Available Itineraries  @endsection

@section('content')
    <!-- START: MODIFY SEARCH -->
    <div class="row modify-search modify-flight">
        <div class="container clear-padding">
            <div class="col-md-3 col-sm-3 open-search-holder search-col-padding hidden-lg hidden-md">
                <div class="form-group">
                    <br/>
                    <button type="button" class="search-button btn transition-effect btn-block open-search">Open Search</button>
                </div>
            </div>
                <div id="round_trip_flight_search_holder" class="search-holder hidden-sm hidden-xs">
                    <div class="clearfix"></div>
                    <div class="col-md-3 col-sm-3 search-col-padding">
                        <label>Departure City</label>
                        <div class="input-group">
                            <input type="text" name="departure_city" class="form-control type-ahead round_trip_departure_city" required placeholder="E.g. London">
                            <span class="input-group-addon"><i class="fa fa-map-marker fa-fw"></i></span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 search-col-padding">
                        <label>Destination City</label>
                        <div class="input-group">
                            <input type="text" name="destination_city" class="form-control type-ahead round_trip_destination_city"  required placeholder="E.g. New York">
                            <span class="input-group-addon"><i class="fa fa-map-marker fa-fw"></i></span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 search-col-padding">
                        <label>Departure Date</label>
                        <div class="input-group">
                            <input type="text" name="departure_date" class="form-control round_trip_departure_date date-picker" placeholder="DD/MM/YYYY">
                            <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 search-col-padding">
                        <label>Return Date</label>
                        <div class="input-group">
                            <input type="text" class="form-control round_trip_return_date date-picker" name="return_date" placeholder="DD/MM/YYYY">
                            <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-3 col-sm-3 search-col-padding">
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
                    <div class="col-md-3 col-sm-3 search-col-padding">
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
                    <div class="col-md-3 col-sm-3 search-col-padding">
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
                    <div class="col-md-3 col-sm-3 search-col-padding">
                        <div class="form-group">
                            <br/>
                            <button type="button" class="search-button btn transition-effect btn-block round_trip_search_flight">Search Flights</button>
                        </div>

                    </div>
                    <div class="clearfix"></div>
                </div>

        </div>
    </div>
    <!-- END: MODIFY SEARCH -->

    <!-- START: LISTING AREA-->
    <div class="row">
        <div class="container">
            <!-- START: FILTER AREA -->
            <div class="col-md-3 clear-padding">
                <div class="filter-head text-center">
                    <h4>{{count($availableItineraries)}} Result Found Matching Your Search.</h4>
                </div>
                <div class="filter-area">
                    <div class="price-filter filter">
                        <h5> Price Filter</h5>
                        <p>
                            <label></label>
                            <input type="text" id="price_filter" readonly>
                        </p>
                        <div id="price-range"></div>
                    </div>
                    <div class="airline-filter filter">
                        <h5 class="show-available-airlines"><i class="fa fa-plane"></i> Airline ({{count($availableAirlines)}}) <i class="fa fa-list pull-right"></i></h5>
                        <ul class="available-airlines hidden-sm hidden-xs">
                            @foreach($availableAirlines as $serial => $airline)
                            <li>
                                <input  type="checkbox" class="airlines select" value="{{$airline}}"><img src="{{\App\Services\AmadeusConfig::airlineLogo($airline)}}" style="height: 60px; width: 60px;" alt="{{$airline}}"> {{\App\Airline::getAirlineName($airline)}}
                            </li>
                             @endforeach
                        </ul>
                    </div>
                    <div class="filter">
                        <h5 class="show-available-stops"><i class="fa fa-stop"></i> Stops ({{count($availableStops)}}) <i class="fa fa-list pull-right"></i></h5>
                        <ul class="available-stops hidden-sm hidden-xs">
                            @foreach($availableStops as $a => $stop)
                            <li>
                                <input type="checkbox" name="options" class="stops select" value="{{$stop}}-stops" > {{$stop}} Stop(s)
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="filter">
                        <h5 class="show-available-cabins"><i class="fa fa-list"></i> Class ({{count($availableCabins)}}) <i class="fa fa-list pull-right"></i></h5>
                        <ul class="available-cabins hidden-sm hidden-xs">
                            @foreach($availableCabins as $serial => $cabin)
                            <li><input type="checkbox" value="{{$cabin}}" class="cabins select"> {{$cabin}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <!-- END: FILTER AREA -->

            <!-- START: INDIVIDUAL LISTING AREA -->
            <div class="col-md-9 flight-listing">
                <!-- START: FLIGHT LIST VIEW -->
                 @foreach($availableItineraries as $serial => $itinerary)
                     <div class="all-itinerary {{$itinerary['cabinType']}} {{$itinerary['stops']}}-stops {{$itinerary['displayAirline']}} {{round($itinerary['displayTotal'] /100)}}-price">
                      <div class="flight-list-view">
                    <div class="airline-logo col-md-2 text-center clear-padding">
                        <img src="{{\App\Services\AmadeusConfig::airlineLogo($itinerary['displayAirline'])}}" style="height: 100px; width: 100px;" alt="{{$itinerary['displayAirline']}}">
                        <h6>{{\App\Airline::getAirlineName($itinerary['displayAirline'])}}</h6>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-8 text-center clear-padding flight-desc">
                        <div class="take-off">
                            <h4><i class="fa fa-plane"></i>{{date('H:i D, M d',strtotime($itinerary['originDestinations'][0]['departureDateTime']))}}</h4>
                            <h5><i class="fa fa-map-marker"></i>{{$itinerary['originDestinations'][0]['departureAirportName']}} ({{$itinerary['originDestinations'][0]['departureAirportCode']}})</h5>
                        </div>
                        <div class="landing">
                            <h4><i class="fa fa-plane fa-rotate-90"></i> {{date('H:i D, M d',strtotime($itinerary['originDestinations'][0]['arrivalDateTime']))}}</h4>
                            <h5><i class="fa fa-map-marker"></i> {{$itinerary['originDestinations'][0]['arrivalAirportName']}} ({{$itinerary['originDestinations'][0]['arrivalAirportCode']}})</h5>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-4 clear-padding flight-desc text-center">
                        <div class="duration">
                            <h4><i class="fa fa-clock-o"></i> {{$itinerary['originDestinations'][0]['journeyTotalDuration']}}(h:m)</h4>
                            <h4>{{$itinerary['stops']}} Stop(s)</h4>
                        </div>
                    </div>
                    <div class="clearfix visible-sm-block visible-xs-block"></div>
                    <div class="col-md-2 flight-book text-center clear-padding">
                        <div class="price">
                            <h4>&#x20a6; {{number_format(($itinerary['displayTotal']/100))}} </h4>
                            <h6>{{$itinerary['cabinType']}}</h6>
                        </div>
                        <div class="book">
                            <a data-toggle="modal" data-target=".flight-details_{{$serial}}" data-backdrop="false" class="btn btn-sm more-details"> More Info <i class="fa fa-plus"></i></a>
                            <input type="hidden" value="{{$serial}}" class="hidden-itinerary-serial"/>
                        </div>
                    </div>
                      </div>
                     </div>

                         <div class="modal fade flight-details_{{$serial}}" tabindex="-1" role="dialog">
                             <div class="modal-dialog modal-lg">
                                 <div class="modal-content">
                                     <div class="modal-body">
                                         <div class="flight-details-header">
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
                                             <h5>FLIGHT DETAILS</h5>
                                             <div class="flight-details-book">
                                                 <div class="col-md-2 col-sm-2 col-xs-4">
                                                     <h3>&#x20a6; {{number_format(($itinerary['displayTotal']/100))}}</h3>
                                                     <h6>{{$itinerary['cabinType']}}</h6>
                                                 </div>
                                                 <div class="col-md-2 col-sm-2 col-xs-4">
                                                     <button class="btn btn-sm btn-block btn_travel_portal continue" value="{{$serial}}"> Continue <i class="fa fa-plane"></i></button>
                                                 </div>
                                             </div>
                                             <div class="clearfix"></div>
                                         </div>
                                         {{-- Not in use but dont delete --}}
                                         <div class="flight-details-body hide hidden">
                                             <ul class="nav nav-tabs">
                                                 <li class="active"><a data-toggle="tab" href="#itinerary-{{$serial}}">Itinerary</a></li>
                                                 <li><a data-toggle="tab" href="#itinerary-info-{{$serial}}">Itinerary Info</a></li>
                                             </ul>
                                             <div class="tab-content">
                                                 <div id="itinerary-{{$serial}}" class="tab-pane fade in active">
                                                     @foreach($itinerary['originDestinations'] as $serial => $originDestination)
                                                         <h5 class="itinerary-date">{{date('D, M d',strtotime($originDestination['departureDateTime']))}}</h5>
                                                         <div class="itinerary-details text-center">
                                                             <div class="flight row">
                                                                 <div class="col-md-1 col-sm-2 col-xs-3">
                                                                     <img src="{{\App\Services\AmadeusConfig::airlineLogo($originDestination['filingAirlineCode'])}}" style="width:60px; height: 60px;" alt="{{$originDestination['filingAirlineCode']}}">
                                                                     <h6>{{\App\Airline::getAirlineName($originDestination['filingAirlineCode'])}}</h6>
                                                                 </div>
                                                                 <div class="col-md-3 col-sm-3 col-xs-3">
                                                                     <h5>{{date('h:m D, M d',strtotime($originDestination['departureDateTime']))}}</h5>
                                                                     <h6>{{$originDestination['departureAirportName']}} ({{$originDestination['departureAirportCode']}})</h6>
                                                                 </div>
                                                                 <div class="col-md-1 col-sm-1 col-xs-1">
                                                                     <i class="fa fa-long-arrow-right"></i>
                                                                 </div>
                                                                 <div class="col-md-3 col-sm-3 col-xs-3">
                                                                     <h5>{{date('h:m D, M d',strtotime($originDestination['arrivalDateTime']))}}</h5>
                                                                     <h6>{{$originDestination['arrivalAirportName']}} ({{$originDestination['arrivalAirportCode']}})</h6>
                                                                 </div>
                                                                 <div class="col-md-2 col-sm-3 col-xs-2">
                                                                     <h5>{{$originDestination['journeyDuration']}}(h:m)</h5>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     @endforeach
                                                 </div>
                                                 <div id="itinerary-info-{{$serial}}" class="tab-pane fade">
                                                     <div class="col-md-6 col-sm-6">
                                                         <h5>Itinerary Information</h5>
                                                         <table>
                                                             <tr>
                                                                 <td>Base Fare</td>
                                                                 <td>$499</td>
                                                             </tr>
                                                             <tr>
                                                                 <td>Development Fee</td>
                                                                 <td>$19</td>
                                                             </tr>
                                                             <tr>
                                                                 <td>Trasnportation</td>
                                                                 <td>$420</td>
                                                             </tr>
                                                             <tr>
                                                                 <td>Service Fee</td>
                                                                 <td>$25</td>
                                                             </tr>
                                                             <tr>
                                                                 <td>Serivce Tax</td>
                                                                 <td>$20</td>
                                                             </tr>
                                                             <tr class="grand-total">
                                                                 <td>Grand Total</td>
                                                                 <td>$599</td>
                                                             </tr>
                                                         </table>
                                                     </div>
                                                     <div class="col-md-6 col-sm-6">
                                                         <h5>Fare Rule</h5>
                                                         <table>
                                                             <tr>
                                                                 <td>Date Change Penality</td>
                                                                 <td>$19</td>
                                                             </tr>
                                                             <tr>
                                                                 <td>Cancellation Penality</td>
                                                                 <td>$25</td>
                                                             </tr>
                                                             <tr>
                                                                 <td>Service Fee</td>
                                                                 <td>$20</td>
                                                             </tr>
                                                         </table>
                                                     </div>
                                                 </div>
                                                 <div id="fare-{{$serial}}" class="tab-pane fare fade">
                                                     <div class="col-md-6 col-sm-6">
                                                         <h5>Fare Details</h5>
                                                         <table>
                                                             <tr>
                                                                 <td>Base Fare</td>
                                                                 <td>$499</td>
                                                             </tr>
                                                             <tr>
                                                                 <td>Development Fee</td>
                                                                 <td>$19</td>
                                                             </tr>
                                                             <tr>
                                                                 <td>Trasnportation</td>
                                                                 <td>$420</td>
                                                             </tr>
                                                             <tr>
                                                                 <td>Service Fee</td>
                                                                 <td>$25</td>
                                                             </tr>
                                                             <tr>
                                                                 <td>Serivce Tax</td>
                                                                 <td>$20</td>
                                                             </tr>
                                                             <tr class="grand-total">
                                                                 <td>Grand Total</td>
                                                                 <td>$599</td>
                                                             </tr>
                                                         </table>
                                                     </div>
                                                     <div class="col-md-6 col-sm-6">
                                                         <h5>Fare Rule</h5>
                                                         <table>
                                                             <tr>
                                                                 <td>Date Change Penality</td>
                                                                 <td>$19</td>
                                                             </tr>
                                                             <tr>
                                                                 <td>Cancellation Penality</td>
                                                                 <td>$25</td>
                                                             </tr>
                                                             <tr>
                                                                 <td>Service Fee</td>
                                                                 <td>$20</td>
                                                             </tr>
                                                         </table>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                         {{-- Not in use but dont delete --}}
                                         <div class="flight-details-body">
                                             <ul class="nav nav-tabs">
                                                 <li class="active">
                                                     <a data-toggle="tab" href=".itinerary-{{$serial}}">Itinerary</a>
                                                 </li>
                                                 <li>
                                                     <a data-toggle="tab" href=".fare-{{$serial}}">Fare Details</a>
                                                 </li>
                                             </ul>
                                             <div class="tab-content">
                                                 <div class="tab-pane fade in active itinerary-{{$serial}}">


                                                     @foreach($itinerary['originDestinations'] as $serial => $originDestination)
                                                         <div class="itinerary-details text-center">
                                                             <div class="flight">
                                                                 <div class="col-md-1 col-sm-2 col-xs-3" align="center">
                                                                     <img src="{{\App\Services\AmadeusConfig::airlineLogo($originDestination['filingAirlineCode'])}}" style="width:60px; height: 60px;" alt="{{$originDestination['filingAirlineCode']}}">
                                                                     <small style="text-align: justify;">{{$originDestination['marketingAirlineCode']}}-{{$originDestination['flightNumber']}}</small><br/>
                                                                 </div>
                                                                 <div class="col-md-3 col-sm-3 col-xs-3">
                                                                     <h5>{{date('h:m D, M d',strtotime($originDestination['departureDateTime']))}}</h5>
                                                                     <h6>{{$originDestination['departureAirportName']}} ({{$originDestination['departureAirportCode']}})</h6>
                                                                 </div>
                                                                 <div class="col-md-1 col-sm-1 col-xs-1">
                                                                     <i class="fa fa-long-arrow-right"></i>
                                                                 </div>
                                                                 <div class="col-md-3 col-sm-3 col-xs-3">
                                                                     <h5>{{date('h:m D, M d',strtotime($originDestination['arrivalDateTime']))}}</h5>
                                                                     <h6>{{$originDestination['arrivalAirportName']}} ({{$originDestination['arrivalAirportCode']}})</h6>
                                                                 </div>
                                                                 <div class="col-md-2 col-sm-3 col-xs-2">
                                                                     <h5>{{$originDestination['journeyDuration']}}(h:m)</h5>
                                                                 </div>
                                                             </div>
                                                             <div class="clearfix"></div>

                                                         </div>
                                                     @endforeach


                                                 </div>
                                                 <div class="tab-pane fade fare fare-{{$serial}}">
                                                     <div class="col-md-6 col-sm-6">
                                                         <h5>Fare Details</h5>
                                                         <table>
                                                             @foreach($itinerary['itineraryPassengerInfo'] as $i => $passengerInfo)
                                                                 <tr>
                                                                     <td>{{$passengerInfo['passengerType']}} ({{$passengerInfo['quantity']}})</td>
                                                                     <td>&#x20a6;{{number_format($passengerInfo['price'] / 100)}}</td>
                                                                 </tr>
                                                             @endforeach
                                                             <tr>
                                                                 <td>VAT</td>
                                                                 <td> + &#x20a6;{{number_format($itinerary['vat']/100)}}</td>
                                                             </tr>
                                                             <tr>
                                                                 <td>Service Fee</td>
                                                                 <td> + &#x20a6;{{number_format($itinerary['adminToCustomerMarkup']/100)}}</td>
                                                             </tr>
                                                             <tr>
                                                                 <td>Discount</td>
                                                                 <td> - &#x20a6;{{number_format($itinerary['airlineMarkdown']/100)}}</td>
                                                             </tr>
                                                             <tr class="grand-total">
                                                                 <td>Grand Total</td>
                                                                 <td>&#x20a6;{{number_format($itinerary['displayTotal'] /100)}}</td>
                                                             </tr>
                                                         </table>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- START: FLIGHT MODAL -->

    <!-- END: FLIGHT MODAL -->
<br/>

@endsection

@section('javascript')
    <script type="text/javascript">
          var minPrice = '{{$minimumPrice}}';
          var maxPrice = '{{$maximumPrice}}';
          var prices   =  $.parseJSON('{{$availablePrices}}');

    </script>
    <script src="{{asset('frontend/assets/js/pages/flight/flight_search_management.js')}}"></script>
    <script src="{{asset('frontend/assets/js/pages/flight/search_result.js')}}"></script>

@endsection

@section('css')

@endsection