@extends('layouts.app')

@section('page-title') profile management @endsection

@section('content')
    <div class="row user-profile">
        <div class="container">
            <div class="col-md-12 user-name">
                <h3>Other Settings</h3>
            </div>
            <div class="col-md-2 col-sm-2">
                <div class="user-profile-tabs">
                    <ul class="nav nav-tabs">
                        <li><a  href="{{ url('setting/other-setting/profile_management') }}" class="text-center"><i class="fa fa-user"></i> <span>Profile management</span></a></li>
                        <li><a  href="{{ url('setting/other-setting/Wallet_management') }}" class="text-center"><i class="fa fa-money"></i> <span>Wallet Management</span></a></li>
                        <li class="active"><a href="{{ url('setting/other-setting/Customer_bookings') }}" class="text-center"><i class="fa fa-book"></i> <span>Customer Bookings</span></a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-10 col-sm-10">

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