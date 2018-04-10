@extends('layouts.app')

@section('page-title') Flight Payment Confirmation @endsection

@section('content')

    <!-- START: PAGE TITLE -->
    <div class="row page-title">
        <div class="container clear-padding text-center flight-title">
            <h3>THANK YOU</h3>
            <h4 class="thank"><i class="fa fa-thumbs-o-up"></i> Your Booking is Confirmed!!</h4>
            <span><i class="fa fa-plane"></i> New York <i class="fa fa-long-arrow-right"></i> New Delhi <i class="fa fa-calendar"></i> SAT, 22 JUL</span>
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
                                <td>Booking ID</td>
                                <td>CR1000CT</td>
                            </tr>
                            <tr>
                                <td>Transaction ID</td>
                                <td>CP12346</td>
                            </tr>
                            <tr>
                                <td>Passenger Name</td>
                                <td>Lenore</td>
                            </tr>
                            <tr>
                                <td>Passenger Email</td>
                                <td>lenore@lmail.com</td>
                            </tr>
                            <tr>
                                <td>Booking ID</td>
                                <td>CR1000CT</td>
                            </tr>
                            <tr>
                                <td>Transaction ID</td>
                                <td>CP12346</td>
                            </tr>
                            <tr>
                                <td>Passenger Name</td>
                                <td>Lenore</td>
                            </tr>
                            <tr>
                                <td>Passenger Email</td>
                                <td>lenore@lmail.com</td>
                            </tr>
                        </table>
                        <p>You can check your email for further details. We have sent you a mail with details.</p>
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
                    <div class="sidebar-item rec-box">
                        <h4><i class="fa fa-bullhorn"></i>Suggestions For You</h4>
                        <div class="sidebar-body">
                            <table class="table">
                                <tr>
                                    <td><i class="fa fa-suitcase"></i> Holidays</td>
                                    <td><a href="#">172 holidays. Starting from $142</a></td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-bed"></i> Hotel</td>
                                    <td><a href="#">150 deals. Starting from $199</a></td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-bed"></i> Hotels</td>
                                    <td><a href="#">172 hotels. Starting from $142</a></td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-suitcase"></i> Holidays</td>
                                    <td><a href="#">150 deals. Starting from $199</a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: BOOKING DETAILS -->

@endsection
