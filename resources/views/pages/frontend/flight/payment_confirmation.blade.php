@extends('layouts.app')

@section('page-title') Flight Payment Confirmation @endsection

@section('content')

    <!-- START: PAGE TITLE -->
    <div class="row page-title">
        <div class="container clear-padding text-center flight-title">
            @if($paymentInfo['status'] == 0)
                <h3>SORRY</h3>
                <h4 class="error"><i class="fa fa-thumbs-o-down"></i> {{$paymentInfo['message']}}</h4>
            @elseif($paymentInfo['status'] == 1)
                <h3>THANK YOU</h3>
                <h4 class="thank"><i class="fa fa-thumbs-o-up"></i> {{$paymentInfo['message']}}</h4>
            @elseif($paymentInfo['status'] == 2)
                <h3>ON HOLD</h3>
                <h4 class="thank"><i class="fa fa-warning"></i> {{$paymentInfo['message']}}</h4>
            @elseif($paymentInfo['status'] == 3)
                <h3>ON HOLD</h3>
                <h4 class="thank"><i class="fa fa-warning"></i> {{$paymentInfo['message']}}</h4>
            @endif


            @foreach($flightSearchParam['flight_search'] as $i => $searchParam)
                <h5><i class="fa fa-plane"></i>{{$searchParam['departure_city']}}<i class="fa fa-long-arrow-right"></i>{{$searchParam['destination_city']}}</h5>
            @endforeach
            <span> <i class="fa fa-male"></i>Traveller(s) - {{$flightSearchParam['no_of_adult']}} Adult, {{$flightSearchParam['no_of_child']}} child, {{$flightSearchParam['no_of_infant']}} Infant </span>
        </div>
    </div>
    <!-- END: PAGE TITLE -->

    <!-- START: BOOKING DETAILS -->
    <div class="row">
        <div class="container clear-padding">
            <div>
                <div class="col-md-8 col-sm-8">
                    <div class=" confirmation-detail">
                        <h3>Booking Details</h3>
                        <table class="table">
                            <tr>
                                <td>Booking Reference</td>
                                <td>{{$booking->reference}}</td>
                            </tr>
                            <tr>
                                <td>Total Amount</td>
                                <td>{{number_format(($booking->total_amount/100),2)}}</td>
                            </tr>
                            <tr>
                                <td>Customer Name</td>
                                <td>{{$profile->first_name}} {{$profile->middle_name}} {{$profile->last_name}}</td>
                            </tr>
                            <tr>
                                <td>Booking Date Time</td>
                                <td>{{$booking->created_at}}</td>
                            </tr>
                            <tr>
                                <td>Ticket Expiry Date</td>
                                <td>{{$booking->ticket_time_limit}}</td>
                            </tr>
                        </table>
                        <p>You can check your bookings history for further details. Manage your bookings from your dashboard.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 booking-sidebar">
                    <div class="sidebar-item contact-box">
                        <h4><i class="fa fa-phone"></i>Need Help?</h4>
                        <div class="sidebar-body text-center">
                            <p>Need Help? Call us or drop a message. Our agents will be in touch shortly.</p>
                            <h2>+91 1234567890</h2>
                        </div>
                    </div>
                    {{--<div class="sidebar-item rec-box">--}}
                        {{--<h4><i class="fa fa-bullhorn"></i>Suggestions For You</h4>--}}
                        {{--<div class="sidebar-body">--}}
                            {{--<table class="table">--}}
                                {{--<tr>--}}
                                    {{--<td><i class="fa fa-suitcase"></i> Holidays</td>--}}
                                    {{--<td><a href="#">172 holidays. Starting from $142</a></td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<td><i class="fa fa-bed"></i> Hotel</td>--}}
                                    {{--<td><a href="#">150 deals. Starting from $199</a></td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<td><i class="fa fa-bed"></i> Hotels</td>--}}
                                    {{--<td><a href="#">172 hotels. Starting from $142</a></td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<td><i class="fa fa-suitcase"></i> Holidays</td>--}}
                                    {{--<td><a href="#">150 deals. Starting from $199</a></td>--}}
                                {{--</tr>--}}
                            {{--</table>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </div>
    <!-- END: BOOKING DETAILS -->

@endsection
