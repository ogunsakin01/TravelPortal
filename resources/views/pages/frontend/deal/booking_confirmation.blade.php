@extends('layouts.app')

@section('page-title') Booking Confirmation @endsection

@section('activeDeals') active @endsection

@section('content')

    <!-- INNER-BANNER -->
    <div class="inner-banner style-6">
        <img class="center-image" src="{{asset('frontend/img/hotel_booking.jpg')}}" style="height: 40px;" alt="">
        <div class="vertical-align">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-8 col-md-offset-2">
                        <ul class="banner-breadcrumb color-white clearfix">
                            <li><a class="link-blue-2" href="{{url('/')}}">home</a> /</li>
                            <li><span>Booking Confirmation</span></li>
                        </ul>
                        <h2 class="color-white">{{$deal->name}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- DETAIL WRAPPER -->
    <div class="detail-wrapper">
        <div class="container">
            <div class="row padd-90">
                <div class="col-xs-12 col-md-8">
                    <div class="detail-content-block">
                        <h3 class="small-title">Booking Confirmation</h3>
                        @if($paymentInfo['status'] == 0)
                            <div class="confirm-label bg-dr-blue-2 radius-5">
                                <img class="confirm-img" src="{{url('frontend/img/flag_icon.png')}}" alt="">
                                <div class="confirm-title color-white">Sorry. {{$paymentInfo['message']}}</div>
                                <div class="confirm-text color-white-light">We are unable to complete your booking, go to your bookings and try again. </div>
                            </div>
                        @elseif($paymentInfo['status'] == 1)
                            <div class="confirm-label bg-dr-blue-2 radius-5">
                                <img class="confirm-img" src="{{url('frontend/img/thx_icon.png')}}" alt="">
                                <div class="confirm-title color-white">Thank You. {{$paymentInfo['message']}}</div>
                                <div class="confirm-text color-white-light">A confirmation email has been sent to your provided email address.</div>
                                <button class="confirm-print c-button b-40 bg-white hv-white-o" onclick="printJS('booking_information', 'html')">print details</button>
                            </div>
                        @elseif($paymentInfo['status'] == 2)
                            <div class="confirm-label bg-dr-blue-2 radius-5">
                                <img class="confirm-img" src="{{url('frontend/img/thx_icon.png')}}" alt="">
                                <div class="confirm-title color-white">On Hold. {{$paymentInfo['message']}}</div>
                                <div class="confirm-text color-white-light">Go to your booking to manage the booking.</div>
                            </div>
                        @elseif($paymentInfo['status'] == 3)
                            <div class="confirm-label bg-dr-blue-2 radius-5">
                                <img class="confirm-img" src="{{url('frontend/img/thx_icon.png')}}" alt="">
                                <div class="confirm-title color-white">On Hold. {{$paymentInfo['message']}}</div>
                                <div class="confirm-text color-white-light">Go to your booking to manage the booking.</div>
                            </div>
                        @endif

                    </div>
                    <div class="detail-content-block">
                        <h3 class="small-title">Booking Information</h3>
                        <div class="table-responsive" id="booking_information">
                            <table class="table style-1 type-2 striped">
                                <tbody>
                                <tr>
                                    <td class="table-label color-grey">RESERVATION REFERENCE:</td>
                                    <td class="table-label color-dark-2"><strong>{{$booking->reference}}</strong></td>
                                </tr>
                                <tr>
                                    <td class="table-label color-grey">DEAL NAME:</td>
                                    <td class="table-label color-dark-2"><strong>{{$deal->name}}</strong></td>
                                </tr>
                                <tr>
                                    <td class="table-label color-grey">ADULTS:</td>
                                    <td class="table-label color-dark-2"><strong>{{$booking->adults}}</strong></td>
                                </tr>
                                <tr>
                                    <td class="table-label color-grey">CHILDREN:</td>
                                    <td class="table-label color-dark-2"><strong>{{$booking->children}}</strong></td>
                                </tr>
                                <tr>
                                    <td class="table-label color-grey">INFANTS:</td>
                                    <td class="table-label color-dark-2"><strong>{{$booking->infants}}</strong></td>
                                </tr>
                                <tr>
                                    <td class="table-label color-grey">AMOUNT:</td>
                                    <td class="table-label color-dark-2"><strong> &#x20A6;{{number_format(($booking->total_amount/100),2)}}</strong></td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="detail-content-block">
                        <div class="simple-text">
                            <h3>Manage Booking</h3>
                            <p class="color-grey">Follow the link below to manage this booking. If your booking was not successful, you can still retry the booking.</p>
                            <div class="custom-panel bg-grey-2 radius-4">
                                <a class="color-dr-blue-2 link-dark-2" href="{{url('/bookings/package/package-reservation-information/'.$booking->reference)}}">{{url('/bookings/package/package-reservation-information/'.$booking->reference)}}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <div class="right-sidebar">
                        <div class="help-contact bg-grey-2">
                            <h4 class="color-dark-2">Need Help?</h4>
                            <p class="color-grey-2">Get additional information on booking and management of this flight. Find our contact details below .</p>
                            <a class="help-phone color-dark-2 link-red-3" href="tel:{{\App\Services\PortalConfig::$adminBookingsNumber}}"><img src="{{asset('frontend/img/detail/phone24-red.png')}}" alt="">{{\App\Services\PortalConfig::$adminBookingsNumber}}</a>
                            <a class="help-mail color-dark-2 link-red-3" href="mailto:{{\App\Services\PortalConfig::$adminBookingsEmail}}"><img src="{{asset('frontend/img/detail/letter-red.png')}}" alt="">{{\App\Services\PortalConfig::$adminBookingsEmail}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
