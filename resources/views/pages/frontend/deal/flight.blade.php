@extends('layouts.app')

@section('page-title') Flight Deals  @endsection

@section('activeFlight') active @endsection

@section('content')

<div class="main-wraper hotel-items bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="second-title">
                    <h2>Find Cheap Flights</h2>
                </div>
                <blockquote class="bg-grey-2 simple-group detail-block">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-entry color-5">
                                <input class="checkbox-form flight-search-option" id="text-1"
                                       type="checkbox" value="One Way">
                                <label class="clearfix" for="text-1">
                                    <span class="sp-check"><i class="fa fa-check"></i></span>
                                    <span class="checkbox-text">One Way</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-entry color-5">
                                <input class="checkbox-form flight-search-option" id="text-2"
                                       type="checkbox" value="Round Trip">
                                <label class="clearfix" for="text-2">
                                    <span class="sp-check"><i class="fa fa-check"></i></span>
                                    <span class="checkbox-text">Round Trip</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-entry color-5">
                                <input class="checkbox-form flight-search-option" id="text-3"
                                       type="checkbox" value="Multi Destination">
                                <label class="clearfix" for="text-3">
                                    <span class="sp-check"><i class="fa fa-check"></i></span>
                                    <span class="checkbox-text">Multi Destination</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div id="one_way_flight_search_holder">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Departure City</label>
                                    <input type="text" placeholder="Airport Name, City IATA Code" value="" class="type-ahead one_way_departure_city dynax_input_2" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Destination City</label>
                                    <input type="text" placeholder="Airport Name, City IATA Code" value="" class="type-ahead one_way_destination_city dynax_input_2" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Departure Date</label>
                                    <input type="text" placeholder="" value="" class="one_way_departure_date date-picker dynax_input_2" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Adults
                                        <small>Above 12yrs</small>
                                    </label>
                                    <select name="adult_count" class="dynax_input_2 one_way_adult_count">
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Children
                                        <small>2 - 12yrs</small>
                                    </label>
                                    <select name="adult_count" class="dynax_input_2 one_way_child_count">
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Infants
                                        <small>Below 2yrs</small>
                                    </label>
                                    <select name="adult_count" class="dynax_input_2 one_way_infant_count">
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
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <button class="btn-block btn-group c-button b-60 one_way_search_flight btn_travel_portal" type="button">Search Now
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="hidden" id="round_trip_flight_search_holder">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Departure City</label>
                                    <input type="text" placeholder="Airport Name, City IATA Code"  value="" class="dynax_input_2 type-ahead round_trip_departure_city" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Destination City</label>
                                    <input type="text" placeholder="Airport Name, City IATA Code" value="" class="dynax_input_2 type-ahead round_trip_destination_city" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Departure Date</label>
                                    <input type="text" placeholder="" class="dynax_input_2 round_trip_departure_date date-picker" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Return Date</label>
                                    <input type="text" placeholder="" class="dynax_input_2 round_trip_return_date date-picker" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Adults
                                        <small>Above 12yrs</small>
                                    </label>
                                    <select name="adult_count" class="dynax_input_2 round_trip_adult_count">
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Children
                                        <small>2 - 12yrs</small>
                                    </label>
                                    <select name="adult_count" class="dynax_input_2 round_trip_child_count">
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Infants
                                        <small>Below 2yrs</small>
                                    </label>
                                    <select name="adult_count" class="dynax_input_2 round_trip_infant_count">
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
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <button class="btn-block btn-group c-button b-60 round_trip_search_flight btn_travel_portal" type="button">Search Now
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="hidden" id="multi_destination_flight_search_holder">
                        <div class="row multi_destination_origin_destinations">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Departure City</label>
                                    <input type="text" placeholder="Airport Name, City IATA Code" value="" class="dynax_input_2 type-ahead multi_destination_departure_city">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="hotels-block">
                                    <label>Destination City</label>
                                    <input type="text" placeholder="Airport Name, City IATA Code" value="" class="dynax_input_2 type-ahead multi_destination_destination_city" >
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="hotels-block">
                                    <label>Departure Date</label>
                                    <input type="text" placeholder="" value="" class="dynax_input_2 multi_destination_departure_date date-picker">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <h4>&nbsp;</h4>
                                    <button class="btn btn-primary btn-sm" id="add_new_trip" type="button">
                                        <i class="fa fa-plus"></i> Add
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Adults <small>Above 12yrs</small> </label>
                                    <select name="adult_count" class="dynax_input_2 multi_destination_adult_count">
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Children <small>2 - 12yrs</small></label>
                                    <select name="adult_count" class="dynax_input_2 multi_destination_child_count">
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
                            <div class="col-md-4">
                                <label>Infants <small>Below 2yrs</small> </label>
                                <select name="adult_count" class="dynax_input_2 multi_destination_infant_count">
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
                        <div class="row">
                            <div class="col-md-3">
                                <button class="btn-block btn-group c-button b-60 multi_destination_search_flight btn_travel_portal" type="button">Search Now </button>
                            </div>
                        </div>
                    </div>
                </blockquote>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12" align="center">
                <div class="second-title">
                    <h3>Flight Deals</h3>
                    <p class="color-grey">Why hold back, plan your trip with cheap flight deals</p>
                </div>
            </div>
            @if(!isset($flights[0]))
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="hotel-item style-7">
                        <div class="radius-top">
                            <img src="{{asset('frontend/assets/portal_images/sorry.jpg')}}" alt="No flight available" title="No flight available" />
                        </div>
                        <div class="title">
                            <h5>from <strong class="color-red-3">Not available</h5>
                            <h6 class="color-grey-3">Not available</h6>
                            <h4><b>Not available</b></h4>
                            <p>Not available</p>
                        </div>
                    </div>
                </div>
            @else
                @foreach($flights as $flight)
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="hotel-item style-7">
                            <div class="radius-top">
                                <img src="{{\App\Services\AmadeusConfig::cityImage(\App\Services\AmadeusConfig::iataCode(\App\FlightDeal::getByPackageId($flight->id)->destination))}}" alt="{{$flight->name}}" title="{{$flight->name}}" />
                            </div>
                            <div class="title">
                                <h5>from <b class="color-red-3">&#x20A6;{{number_format($flight->adult_price)}}</b> / person</h5>
                                <h4><b>{{$flight->name}}</b></h4>
                                <div class="clearfix">
                                    <a href="#" class="c-button b-40 bg-red-3 hv-red-3-o fl"> <img src="{{asset('frontend/img/flag_icon_grey.png')}}" alt=""> SELECT</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="row">
            <div class="col-md-12">
                {{$flights->links()}}
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script src="{{asset('frontend/js/pages/flight/flight_search_management.js')}}"></script>
@endsection
