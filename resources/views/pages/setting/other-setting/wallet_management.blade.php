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
                        <li class="active"><a  href="{{ url('setting/other-setting/Wallet_management') }}" class="text-center"><i class="fa fa-money"></i> <span>Wallet Management</span></a></li>
                        <li ><a href="{{ url('setting/other-setting/Customer_bookings') }}" class="text-center"><i class="fa fa-book"></i> <span>Customer Bookings</span></a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-10 col-sm-10">
                    <div class="container clear-padding">
                        <div class="col-md-10 search-section">
                            <div role="tabpanel">
                                <!-- BEGIN: CATEGORY TAB -->
                                <ul class="nav nav-tabs search-top" role="tablist" id="searchTab">
                                    <li role="presentation" class="text-center">
                                        <a href="#flight" aria-controls="flight" role="tab" data-toggle="tab">
                                            <i class="fa fa-money"></i>
                                            <span>WALLET</SPAN>
                                        </a>
                                    </li>
                                    <li role="presentation" class="active  text-center">
                                        <a href="#hotel" aria-controls="hotel" role="tab" data-toggle="tab">
                                            <i class="fa fa-bank"></i>
                                            <span>BANK DEPOSIT</span>
                                        </a>
                                    </li>
                                    <li role="presentation" class="text-center">
                                        <a href="#holiday" aria-controls="holiday" role="tab" data-toggle="tab">
                                            <i class="fa fa-suitcase"></i>
                                            <span>ONLINE DEPOSIT</span>
                                        </a>
                                    </li>
                                </ul>

                                <!-- BEGIN: TAB PANELS -->
                                <div class="tab-content">
                                    <!-- BEGIN: Wallet -->
                                    <div role="tabpanel" class="tab-pane" id="flight">
                                        <div class="col-md-12 product-search-title">Wallet Log</div>
                                    </div>
                                    <!-- END: Wallet -->

                                    <!-- START: Bank -->
                                    <div role="tabpanel" class="tab-pane active" id="hotel">
                                        <div class="col-md-12 product-search-title">Wallet Bank Deposit</div>
                                    </div>
                                    <!-- END: Bank -->

                                    <!-- START: BEGIN Online -->
                                    <div role="tabpanel" class="tab-pane" id="holiday">
                                        <div class="col-md-12 product-search-title">Wallet Online Deposit</div>
                                    </div>
                                    <!-- END: Online -->

                                </div>


                            </div>
                        </div>
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

        .search-section{
            margin: 0px 0px;
        }
    </style>
@endsection