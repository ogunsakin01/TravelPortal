@extends('layouts.app')

@section('page-title') Hot Deals  @endsection

@section('activeDeals') active @endsection

@section('content')


    <div class="main-wraper padd-90">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="second-title">
                        <h2>Hot Travel Deals</h2>
                        <p class="color-grey">Let us help you plan your next trip to the world.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($hotDeals as $serial => $hotDeal)
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <div class="radius-mask tour-block hover-aqua">

                            <div class="clip">
                                @if($hotDeal->flight == 1 && $hotDeal->hotel == 0 && $hotDeal->attraction == 0)
                                    <div class="bg bg-bg-chrome act" style="background-image:url({{\App\Services\AmadeusConfig::cityImage(\App\Services\AmadeusConfig::iataCode($hotDeal->flightDeal->destination))}})"></div>
                                @else
                                    @if(isset($hotDeal->images[0]['image_path']))
                                        <div class="bg bg-bg-chrome act" style="background-image:url({{asset($hotDeal->images[0]->image_path)}})"></div>
                                    @else
                                        @if(isset($hotDeal->hotelDeal['city']))
                                           <div class="bg bg-bg-chrome act" style="background-image:url({{ \App\Services\AmadeusConfig::cityImage(\App\Services\AmadeusConfig::iataCode($hotDeal->hotelDeal->city)) }} )"></div>
                                        @else
                                            <div class="bg bg-bg-chrome act" style="background-image:url({{ \App\Services\AmadeusConfig::cityImage(\App\Services\AmadeusConfig::iataCode($hotDeal->attractionDeal->city)) }} )"></div>
                                        @endif
                                    @endif
                                @endif
                            </div>
                            <div class="tour-layer delay-1"></div>
                            <div class="tour-caption">
                                <div class="vertical-align">
                                    <h3 class="hover-it">{{$hotDeal->name}}</h3>
                                    @if($hotDeal->hotel == 1)
                                    <div class="rate">
                                        @for($i = 0; $i < $hotDeal->hotelDeal->star_rating; $i++)
                                            <span class="fa fa-star color-yellow"></span>
                                        @endfor
                                        @for($i = 0; $i < (5-$hotDeal->hotelDeal->star_rating); $i++)
                                            <span class="fa fa-star-o color-yellow"></span>
                                        @endfor
                                    </div>
                                    @endif
                                    <h4>from <b>&#x20a6;{{number_format($hotDeal->adult_price)}}</b></h4>
                                </div>
                                <div class="vertical-bottom">
                                    <div class="fl">
                                        @if($hotDeal->hotel == 1)
                                            <div class="tour-info">
                                                <img src="{{asset('frontend/img/calendar_icon.png')}}"
                                                     alt="{{$hotDeal->name}}">
                                                <span class="font-style-2 color-grey-4">
                                                <strong class="color-white"> {{$hotDeal->hotelDeal->stay_start_date}}</strong>
                                                 to
                                                <strong class="color-white">{{$hotDeal->hotelDeal->stay_end_date}}</strong>
                                            </span>
                                            </div>
                                        @elseif($hotDeal->flight == 1 && $hotDeal->hotel == 0 && $hotDeal->attraction == 0)
                                            <div class="tour-info">
                                                <span class="font-style-2 color-grey-4">
                                                <strong class="color-white"> {{$hotDeal->flightDeal->origin}}</strong>
                                                 to
                                                <strong class="color-white">{{$hotDeal->flightDeal->destination}}</strong>
                                            </span>
                                            </div>
                                        @endif
                                    </div>
                                    <a href="{{url('deals/details/'.$hotDeal->id)}}" class="c-button b-50 bg-aqua hv-transparent fr">
                                        <img src="{{asset('frontend/img/flag_icon.png')}}" alt="{{$hotDeal->name}}">
                                        <span>Select</span>
                                    </a>
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

@endsection
