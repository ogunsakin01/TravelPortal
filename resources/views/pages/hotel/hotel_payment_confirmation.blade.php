@extends('layouts.app')

@section('page-title') Hotel Result  @endsection

@section('content')

<!-- START: PAGE TITLE -->
<div class="row page-title">
    <div class="container clear-padding text-center flight-title">
        <h3>{{$hotelInformation['hotelName']}}</h3>
        <h5>
            @for($i = 0; $i < $hotelInformation['hotelStarRating']; $i++)
                <i class="fa fa-star"></i>
            @endfor
            @for($i = 0; $i < (5-$hotelInformation['hotelStarRating']); $i++)
                <i class="fa fa-star-o"></i>
            @endfor
        </h5>
        <p><i class="fa fa-map-marker"></i> {{$hotelInformation['hotelAddress']}}</p>
        @if($paymentInfo['status'] == 0)
            <h4>SORRY</h4>
            <h4 class="error"><i class="fa fa-thumbs-o-down"></i> {{$paymentInfo['message']}}</h4>
        @elseif($paymentInfo['status'] == 1 && $paymentInfo['hotelBookingStatus'] == 1)
            <h4>THANK YOU</h4>
            <h4 class="thank"><i class="fa fa-thumbs-o-up"></i> The room has been reserved successfully</h4>
        @elseif($paymentInfo['status'] == 1 && $paymentInfo['hotelBookingStatus'] != 1)
            <h4>THANK YOU</h4>
            <h4 class="thank"><i class="fa fa-thumbs-o-up"></i> Your payment was successful but we are unable to reserve the room for you. Kindly contact our customer care for more details</h4>
        @elseif($paymentInfo['status'] == 2)
            <h4>ON HOLD</h4>
            <h4 class="thank"><i class="fa fa-warning"></i> {{$paymentInfo['message']}}</h4>
        @elseif($paymentInfo['status'] == 3)
            <h4>ON HOLD</h4>
            <h4 class="thank"><i class="fa fa-warning"></i> {{$paymentInfo['message']}}</h4>
        @endif

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
                            <td>Reservation Reference</td>
                            <td>{{$bookingInfo['reference']}}</td>
                        </tr>
                        <tr>
                            <td>Hotel Booking Code</td>
                            <td>{{$bookingInfo['pnr']}}</td>
                        </tr>
                        <tr>
                            <td>Hotel Name</td>
                            <td>{{$hotelInformation['hotelName']}}</td>
                        </tr>
                        <tr>
                            <td>Room Description</td>
                            <td>{{$selectedRoom['roomDescription']}}</td>
                        </tr>
                        <tr>
                            <td>Guests</td>
                            <td>{{$searchParam['adult_count']}} adult(s), {{$searchParam['child_count']}} child(s)</td>
                        </tr>
                        <tr>
                            <td>Check In</td>
                            <td>{{date('d, D M. Y',strtotime($hotelInformation['startDate']))}}</td>
                        </tr>
                        <tr>
                            <td>Check Out</td>
                            <td>{{date('d, D M. Y',strtotime($hotelInformation['endDate']))}}</td>
                        </tr>
                        <tr>
                            <td>Hotel Contact Number</td>
                            <td>{{$hotelInformation['hotelContactNumber']}}</td>
                        </tr>
                        <tr>
                            <td>Hotel Address</td>
                            <td>{{$hotelInformation['hotelAddress']}}</td>
                        </tr>
                    </table>
                    <p>For successful booking, an email containing this information has been sent to your email.<br/> To go to your dashboard, <a href="{{url('/dashboard')}}">click here</a></p>
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

            </div>
        </div>
    </div>
</div>
<!-- END: BOOKING DETAILS -->

@endsection
