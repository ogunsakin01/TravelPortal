@extends('layouts.app')

@section('page-title') Hotel Result  @endsection

@section('content')

    <!-- START: MODIFY SEARCH -->
    <div class="row modify-search modify-hotel">
        <div class="container clear-padding">
                <div class="col-md-4">
                    <div class="form-gp">
                        <label>Location</label>
                        <div class="input-group margin-bottom-sm">
                            <input type="text" name="city" class="form-control type-ahead hotel_city" required placeholder="E.g. London">
                            <span class="input-group-addon"><i class="fa fa-map-marker fa-fw"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-6">
                    <div class="form-gp">
                        <label>Check In</label>
                        <div class="input-group margin-bottom-sm">
                            <input type="text" id="check_in" name="check_in" class="form-control  date-picker check_in_date" placeholder="DD/MM/YYYY">
                            <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-6">
                    <div class="form-gp">
                        <label>Check Out</label>
                        <div class="input-group margin-bottom-sm">
                            <input type="text" id="check_out" name="check_out" class="form-control date-picker check_out_date" required placeholder="DD/MM/YYYY">
                            <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 col-sm-6 col-xs-3">
                    <div class="form-gp">
                        <label>Adults</label>
                        <select class="form-control adult_count">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-1 col-sm-6 col-xs-3">
                    <div class="form-gp">
                        <label>Child</label>
                        <select class="form-control child_count">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-9">
                    <div class="form-gp">
                        <button type="button" class="modify-search-button btn transition-effect hotel_search">MODIFY SEARCH</button>
                    </div>
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
                    <h4>{{count($availableHotels)}} Result Found Matching Your Search.</h4>
                </div>
                <div class="filter-area">
                    <div class="price-filter filter">
                        <h5><i class="fa fa-usd"></i> Price</h5>
                        <p>
                            <label></label>
                            <input type="text" id="price_filter" readonly>
                        </p>
                        <div id="price-range"></div>
                    </div>
                    <div class="star-filter filter">
                        <h5 class="show-star-ratings"><i class="fa fa-star"></i> Star <i class="fa fa-list pull-right"></i></h5>
                        <ul class="hidden-sm hidden-xs available-star-ratings">
                            @foreach($starRatings as $serial => $starRating)
                                <li>
                                    <input type="checkbox" value="{{$starRating}}-rating" class="select">
                                    @for($i = 0; $i < $starRating; $i++)
                                    <i class="fa fa-star"></i>
                                    @endfor
                                    @for($i = 0; $i < (5-$starRating); $i++)
                                        <i class="fa fa-star-o"></i>
                                    @endfor
                                </li>
                            @endforeach
                            <li><input type="checkbox" value="all" class="select"> <i class="fa fa-star"></i> Any</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- END: FILTER AREA -->

            <!-- START: INDIVIDUAL LISTING AREA -->
            <div class="col-md-9 hotel-listing text-center">

                <!-- START: SORT AREA -->

                <!-- END: SORT AREA -->

                <div class="clearfix"></div>
                <div class="switchable col-md-12 clear-padding">
                @foreach($availableHotels as $serial => $availableHotel)
                    <div class="hotel-list-view {{round($availableHotel['minimumRate']/100)}}-price {{$availableHotel['hotelStarRating']}}-rating all-hotel">
                        <div class="wrapper">
                            <div class="col-md-4 col-sm-6 switch-img clear-padding">
                                @if(is_array($availableHotel['hotelImage']))
                                    <img src="{{\App\Services\AmadeusConfig::cityImage($availableHotel['hotelCityCode'])}}" alt="{{$availableHotel['hotelName']}}">
                                @elseif(file_exists($availableHotel['hotelImage']))
                                    <img src="{{$availableHotel['hotelImage']}}" alt="{{$availableHotel['hotelName']}}">
                                @elseif(!file_exists($availableHotel['hotelImage']))
                                    <img src="{{\App\Services\AmadeusConfig::cityImage($availableHotel['hotelCityCode'])}}" alt="{{$availableHotel['hotelName']}}">
                                @endif
                            </div>
                            <div class="col-md-6 col-sm-6 hotel-info">
                                <div>
                                    <div class="hotel-header">
                                        <h5>{{$availableHotel['hotelName']}} <br/>
                                            <span>
                                                @for($i = 0; $i < $availableHotel['hotelStarRating']; $i++)
                                                    <i class="fa fa-star colored"></i>
                                                @endfor

                                                @for($i = 0; $i < (5 - $availableHotel['hotelStarRating']); $i++)
                                                     <i class="fa fa-star-o colored"></i>
                                                @endfor
                                            </span>
                                        </h5>
                                        <p><i class="fa fa-map-marker"></i>{{$availableHotel['hotelAddress']}} <br/> <i class="fa fa-phone"></i>{{$availableHotel['hotelContactNumber']}}</p>
                                    </div>
                                    <div class="hotel-facility">
                                        <p><i class="fa fa-wifi" title="Free Wifi"></i><i class="fa fa-bed" title="Luxury Bedroom"></i><i class="fa fa-taxi" title="Transportation"></i><i class="fa fa-beer" title="Bar"></i><i class="fa fa-cutlery" title="Restaurant"></i></p>
                                    </div>
                                    <div class="hotel-desc">
                                        <p>{{substr($availableHotel['hotelInformation'],0,100)}} ....</p>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix visible-sm-block"></div>
                            <div class="col-md-2 rating-price-box text-center clear-padding">
                                <div class="room-book-box">
                                    <div class="price">
                                        <h5>&#x20A6;{{number_format($availableHotel['minimumRate']/100)}} <br/><small>(Excluding Tax)</small></h5>
                                    </div>
                                    <div class="book">
                                        <button class="btn_travel_portal select_hotel" value="{{$serial}}">Select</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>

            </div>
            <!-- END: INDIVIDUAL LISTING AREA -->
        </div>
    </div>
    <!-- END: LISTING AREA -->
<br/>
@endsection

@section('javascript')
    <script type="text/javascript">
        let minPrice = '{{$minimumPrice}}';
        let maxPrice = '{{$maximumPrice}}';
        let prices   =  $.parseJSON('{{$availablePrices}}');
        console.log(prices);
    </script>
    <script src="{{asset('frontend/assets/js/pages/hotel/hotel_search_management.js')}}"></script>
    <script src="{{asset('frontend/assets/js/pages/hotel/search_result.js')}}"></script>
@endsection

@section('css')

@endsection