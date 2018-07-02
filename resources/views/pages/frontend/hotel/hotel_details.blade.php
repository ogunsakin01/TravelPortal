@extends('layouts.app')

@section('page-title') Hotel Result  @endsection

@section('content')

    <!-- START: PAGE TITLE -->
    <div class="row page-title">
        <div class="container clear-padding text-center">
            <h3>{{strtoupper($hotelInformation['hotelName'])}}</h3>
            <h5>
                @for($i = 0; $i < $hotelInformation['hotelStarRating']; $i++)
                    <i class="fa fa-star"></i>
                @endfor
                    @for($i = 0; $i < (5-$hotelInformation['hotelStarRating']); $i++)
                        <i class="fa fa-star-o"></i>
                    @endfor
            </h5>
            <p><i class="fa fa-map-marker"></i> {{$hotelInformation['hotelAddress']}}</p>
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
                            @if(is_array($hotelInformation['hotelImages']))
                                @foreach($hotelInformation['hotelImages'] as $i => $images)
                                    <li>
                                            <img src="{{$images['url']}}" alt="{{$images['title']}}">
                                    </li>
                                @endforeach
                            @else
                                <li>
                                <img src="{{\App\Services\AmadeusConfig::cityImage($hotelInformation['hotelCityCode'])}}" alt="{{$hotelInformation['hotelName']}}">
                                </li>
                            @endif

                        </ul>
                    </div>
                    <div id="carousel" class="flexslider">
                        <ul class="slides">
                            @if(is_array($hotelInformation['hotelImages']))
                                @foreach($hotelInformation['hotelImages'] as $i => $images)
                                    <li>
                                         <img src="{{$images['url']}}" alt="{{$images['title']}}">
                                    </li>
                                @endforeach
                            @else
                                <li>
                                    <img src="{{\App\Services\AmadeusConfig::cityImage($hotelInformation['hotelCityCode'])}}" alt="{{$hotelInformation['hotelName']}}">
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 detail clear-padding">
                    <div class="review sidebar-item">
                        <h4><i class="fa fa-comments"></i> Hotel Rating</h4>
                        <div class="sidebar-item-body text-center">
                            <div class="rating-box">
                                <div class="col-md-12clear-padding">
                                    @for($i = 0; $i < $hotelInformation['hotelStarRating']; $i++)
                                        <i class="fa fa-star"></i>
                                    @endfor

                                    @for($i = 0; $i < (5 - $hotelInformation['hotelStarRating']); $i++)
                                        <i class="fa fa-star-o"></i>
                                    @endfor
                                    <i class="fa fa-users"></i>
                                    <h5>{{$hotelInformation['hotelStarRating']}} Star(s) Rating</h5>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="guest-say rating-box">
                                <div class="col-md-5 col-sm-5 col-xs-5 clear-padding user-img">
                                    @if(!is_array($hotelInformation['hotelImage']))
                                        <img src="{{$hotelInformation['hotelImage']}}" alt="{{$hotelInformation['hotelName']}}">
                                    @else
                                        <img src="{{\App\Services\AmadeusConfig::cityImage($hotelInformation['hotelCityCode'])}}" alt="{{$hotelInformation['hotelName']}}">
                                    @endif
                                </div>
                                <div class="col-md-7 col-sm-7 col-xs-7 clear-padding user-name">
                                    <span>{{$hotelInformation['hotelCityName']}}, {{$hotelInformation['hotelCountryCode']}}</span>
                                    <span>
                                        @for($i = 0; $i < $hotelInformation['hotelStarRating']; $i++)
                                            <i class="fa fa-star"></i>
                                        @endfor
                                        @for($i = 0; $i < (5-$hotelInformation['hotelStarRating']); $i++)
                                            <i class="fa fa-star-o"></i>
                                        @endfor
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
                        <li class="col-md-3 col-sm-3 col-xs-2 text-center"><a data-toggle="tab" href="#ammenties"><i class="fa fa-bed"></i> <span>Amenities</span></a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="overview" class="tab-pane fade">
                            <h4 class="tab-heading">About {{$hotelInformation['hotelName']}}</h4>
                            <p>{{$hotelInformation['hotelInformation']}}</p>
                        </div>
                        <div id="room-info" class="tab-pane fade in active">
                            <h4 class="tab-heading">Room Types</h4>
                            @foreach($hotelInformation['availableRooms'] as $ro => $room)
                            <div class="room-info-wrapper">
                                <div class="col-md-4 col-sm-6 clear-padding">
                                    @if(is_array($hotelInformation['hotelImages']))
                                        <img src="{{$hotelInformation['hotelImages'][rand(0,(count($hotelInformation['hotelImages']) -1))]['url']}}" alt="{{$images['title']}}">
                                    @else
                                        <img src="{{\App\Services\AmadeusConfig::cityImage($hotelInformation['hotelCityCode'])}}" alt="{{$hotelInformation['hotelName']}}">
                                    @endif
                                </div>
                                <div class="col-md-5 col-sm-6 room-desc">
                                    <h4>{{$room['roomDescription']}}</h4>
                                    <h5>Category: {{$room['roomCategory']}}</h5>
                                    <p>Bed Type - {{$room['bedType']}}, Number of Beds - {{$room['numOfBed']}}</p>
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
                                        <h3>&#x20A6;{{number_format(round($room['roomPrice']/100))}}</h3>
                                    </div>
                                    <div class="book">
                                        <a href="{{url('/hotel-room-booking/'.$ro)}}"> SELECT </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div id="ammenties" class="tab-pane fade">
                            <div class="ammenties-5">
                                @foreach($hotelInformation['hotelAmenities'] as $a => $hotelAmenity)
                                <div class="col-md-4 col-xs-6">
                                    <p><i class="fa fa-check-square-o"></i> {{$hotelAmenity}}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 hotel-detail-sidebar">
                <div class="col-md-12 sidebar-wrapper clear-padding">
                    <div class="contact sidebar-item">
                        <h4><i class="fa fa-phone"></i> Contact Hotel</h4>
                        <div class="sidebar-item-body">
                            <h5><i class="fa fa-phone"></i>       {{$hotelInformation['hotelContactNumber']}} </h5>
                            <h5><i class="fa fa-map-marker"></i>  {{$hotelInformation['hotelAddress']}}       </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: ROOM GALLERY -->

@endsection

@section('javascript')
    <script src="{{asset('assets/js/pages/hotel/hotel_details.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery.flexslider-min.js')}}"></script>
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