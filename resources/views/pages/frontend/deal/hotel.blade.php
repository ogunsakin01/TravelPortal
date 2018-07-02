@extends('layouts.app')

@section('page-title') Hotel Deals  @endsection

@section('activeHotel') active @endsection

@section('content')


    <div class="main-wraper padd-90">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="second-title">
                        <h2>Find Hotels</h2>
                    </div>
                    <blockquote class=" bg-grey-2 simple-group detail-block">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="hotels-block">
                                    <h5>Where ?</h5>
                                    <input type="text" placeholder="Enter a destination or hotel city"
                                           class="type-ahead hotel_city dynax_input_2" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="hotels-block">
                                    <h5>Check in</h5>
                                    <input type="text" class="dynax_input_2 date-picker check_in_date"
                                           placeholder="DD/MM/YYYY" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="hotels-block">
                                    <h5>Check out</h5>
                                    <input type="text" class="dynax_input_2 date-picker check_out_date"
                                           placeholder="DD/MM/YYYY" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="hotels-block">
                                    <h5>Adults</h5>
                                    <select name="adult_count" id="hotel_adult_count" class="dynax_input_2 adult_count">
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
                            <div class="col-md-2">
                                <div class="hotels-block">
                                    <h5>Children</h5>
                                    <select name="adult_count" id="hotel_child_Count" class="dynax_input_2 child_count">
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
                            <div class="col-md-2">
                                <div class="form-group" style="text-align: center">
                                    <label></label>
                                    <button class="btn-block btn-group c-button b-60 hotel_search btn_travel_portal" type="button">Search Now</button>
                                </div>
                            </div>
                        </div>
                    </blockquote>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="second-title">
                        <h2>Top Hotel Deals</h2>
                        <p class="color-grey">Select and book cheap hotels through {{config('app.name')}} hotel deals.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($hotelDeals as $serial => $hotelDeal)
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="radius-mask tour-block hover-aqua">
                        <div class="clip">
                        @if(isset($hotelDeal->images[0]->image_path))
                             <div class="bg bg-bg-chrome act" style="background-image:url({{asset($hotelDeal->images[0]->image_path)}})"></div>
                            @else
                             <div class="bg bg-bg-chrome act" style="background-image:url({{ \App\Services\AmadeusConfig::cityImage(\App\Services\AmadeusConfig::iataCode($hotelDeal->hotelDeal->name)) }} )"></div>
                            @endif
                        </div>
                        <div class="tour-layer delay-1"></div>
                        <div class="tour-caption">
                            <div class="vertical-align">
                                <h3 class="hover-it">{{$hotelDeal->hotelDeal->name}}</h3>
                                <div class="rate">
                                    @for($i = 0; $i < $hotelDeal->hotelDeal->star_rating; $i++)
                                        <span class="fa fa-star color-yellow"></span>
                                    @endfor
                                    @for($i = 0; $i < (5-$hotelDeal->hotelDeal->star_rating); $i++)
                                        <span class="fa fa-star-o color-yellow"></span>
                                    @endfor
                                </div>
                                <h4>from <b>&#x20a6;{{number_format($hotelDeal->adult_price)}}</b></h4>
                            </div>
                            <div class="vertical-bottom">
                                <div class="fl">
                                    <div class="tour-info">
                                        <img src="{{asset('frontend/img/calendar_icon.png')}}" alt="{{$hotelDeal->hotelDeal->name}}">
                                        <span class="font-style-2 color-grey-4"><strong class="color-white"> {{$hotelDeal->hotelDeal->stay_start_date}}</strong> to <strong class="color-white"> {{$hotelDeal->hotelDeal->stay_end_date}}</strong></span>
                                    </div>
                                </div>
                                <a href="{{url('deals/details/'.$hotelDeal->id)}}" class="c-button b-50 bg-aqua hv-transparent fr"><img src="{{asset('frontend/img/flag_icon.png')}}" alt="{{$hotelDeal->hotelDeal->name}}"><span>Select</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>



@endsection

@section('js')
    <script src="{{asset('frontend/js/pages/hotel/hotel_search_management.js')}}"></script>
@endsection
