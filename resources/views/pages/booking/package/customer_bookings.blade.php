@extends('layouts.app')

@section('page-title') Customer Package Booking @endsection

@section('content')
    <div class="row user-profile">
        <div class="container">
            <div class="col-md-12 user-name">
                <h3>Hotel Booking</h3>
            </div>
            <div class="col-md-2 col-sm-2">
                <div class="user-profile-tabs">
                    <ul class="nav nav-tabs">
                        <li><a  href="{{ url('booking/package/my_bookings') }}" class="text-center"><i class="fa fa-bolt"></i> <span>My Booking</span></a></li>
                        <li ><a  href="{{ url('booking/package/agent_bookings') }}" class="text-center"><i class="fa fa-history"></i> <span>Agent Booking</span></a></li>
                        <li class="active"><a href="{{ url('booking/package/customer_bookings') }}" class="text-center"><i class="fa fa-user"></i> <span>Customer Booking</span></a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-10 col-sm-10">
                <div class="booking-tab">
                    <h3>Customer Package Bookings </h3>
                </div>


                <div class="table-responsive" style="background-color: white;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Reference</th>
                                <th>Customer Names</th>
                                <th>Customer Email</th>
                                <th>Customer Phone Number</th>
                                <th>Package Name</th>
                                <th>Contact Number</th>
                                <th>Includes</th>
                                <th>Adults</th>
                                <th>Children</th>
                                <th>Infants</th>
                                <th>Price (₦)</th>
                                <th>Status</th>
                                <th>Booked on</th>
                            </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>
                </div>
            </div>

        </div>


    </div>

@endsection

@section('css')
    <style>

        .booking-tab h3{
            color: rgba(0,0,0,.9);
            font-weight: 500;
            text-align: center;
            padding: -10px 0;
            margin: -10px 0;
        }
    </style>
@endsection