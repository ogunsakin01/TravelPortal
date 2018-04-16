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
                        <li class="active"><a  href="{{ url('setting/other-setting/profile_management') }}" class="text-center"><i class="fa fa-user"></i> <span>Profile management</span></a></li>
                        <li><a  href="{{ url('setting/other-setting/Wallet_management') }}" class="text-center"><i class="fa fa-money"></i> <span>Wallet Management</span></a></li>
                        <li ><a href="{{ url('setting/other-setting/Customer_bookings') }}" class="text-center"><i class="fa fa-book"></i> <span>Customer Bookings</span></a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-10 col-sm-10">
                <div id="profile" class="tab-pane fade in">
                    <div class="col-md-6">
                        <div class="user-personal-info">
                            <h4>Personal Information</h4>
                            <div class="user-info-body">
                                <form >
                                    <div class="col-md-6 col-sm-6">
                                        <label>First Name</label>
                                        <input type="text" name="fname" required placeholder="First Name" class="form-control">
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>First Name</label>
                                        <input type="text" name="lname" required placeholder="Last Name" class="form-control">
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12">
                                        <label>Email-ID</label>
                                        <input type="email" name="email" required placeholder="lenore@example.com" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label>Contact Number</label>
                                        <input type="text" name="contact" required class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label>Date Of Birth</label>
                                        <div class="clearfix"></div>
                                        <div class="col-md-4 col-sm-4 col-xs-4 clear-padding">
                                            <select class="form-control" name="day">
                                                <option>Day</option>
                                                <option>01</option>
                                                <option>02</option>
                                                <option>03</option>
                                                <option>04</option>
                                                <option>05</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-4">
                                            <select class="form-control" name="month">
                                                <option>Month</option>
                                                <option>01</option>
                                                <option>02</option>
                                                <option>03</option>
                                                <option>04</option>
                                                <option>05</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-4 clear-padding">
                                            <select class="form-control" name="year">
                                                <option>Year</option>
                                                <option>1990</option>
                                                <option>1991</option>
                                                <option>1992</option>
                                                <option>1993</option>
                                                <option>1994</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Current Address</label>
                                        <textarea placeholder="Your Current Address" id="current-address" class="form-control" rows="5"></textarea>
                                        <div class="col-md-6 col-sm-6 col-xs-6 clear-padding">
                                            <input type="text" name="zip-code" class="form-control" placeholder="Zip Code">
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <input type="text" name="zip-code" class="form-control" placeholder="City">
                                        </div>
                                        <div class="col-md-6 col-sm-6 clear-padding">
                                            <select class="form-control" name="country">
                                                <option>Country</option>
                                                <option>Australia</option>
                                                <option>India</option>
                                                <option>USA</option>
                                                <option>UK</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <select class="form-control" name="state">
                                                <option>State</option>
                                                <option>CA</option>
                                                <option>GA</option>
                                                <option>NY</option>
                                                <option>SA</option>
                                                <option>WA</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Upload Avatar</label>
                                        <input type="file" name="profile-pic" class="upload-pic">
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 text-center">
                                        <button type="submit">SAVE CHANGES</button>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 text-center">
                                        <a href="#">CANCEL</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="user-change-password">
                            <h4>Change Password</h4>
                            <div class="change-password-body">
                                <form >
                                    <div class="col-md-12">
                                        <label>Old Password</label>
                                        <input type="password" placeholder="Old Password" class="form-control" name="old-password">
                                    </div>
                                    <div class="col-md-12">
                                        <label>New Password</label>
                                        <input type="password" placeholder="New Password" class="form-control" name="new-password">
                                    </div>
                                    <div class="col-md-12">
                                        <label>Confirm Password</label>
                                        <input type="password" placeholder="Confirm Password" class="form-control" name="confirm-password">
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button type="submit">SAVE CHANGES</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="user-preference">
                            <h4 data-toggle="collapse" data-target="#flight-preference" aria-expanded="false" aria-controls="flight-preference">
                                <i class="fa fa-plane"></i> Flight Preference <span class="pull-right"><i class="fa fa-chevron-down"></i></span>
                            </h4>
                            <div class="collapse" id="flight-preference">
                                <form >
                                    <div class="col-md-6 col-sm-6">
                                        <label>Price Range</label>
                                        <select class="form-control" name="flight-price-range">
                                            <option>Upto $199</option>
                                            <option>Upto $250</option>
                                            <option>Upto $499</option>
                                            <option>Upto $599</option>
                                            <option>Upto $1000</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>Food Preference</label>
                                        <select class="form-control" name="flight-food">
                                            <option>Indian</option>
                                            <option>Chineese</option>
                                            <option>Sea Food</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>Airline</label>
                                        <select class="form-control" name="flight-airline">
                                            <option>Indigo</option>
                                            <option>Vistara</option>
                                            <option>Spicejet</option>
                                        </select>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 text-center">
                                        <button type="submit">SAVE CHANGES</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="user-preference">
                            <h4 data-toggle="collapse" data-target="#hotel-preference" aria-expanded="false" aria-controls="hotel-preference">
                                <i class="fa fa-bed"></i> Hotel Preference <span class="pull-right"><i class="fa fa-chevron-down"></i></span>
                            </h4>
                            <div class="collapse" id="hotel-preference">
                                <form >
                                    <div class="col-md-6 col-sm-6">
                                        <label>Price Range</label>
                                        <select class="form-control" name="hotel-price-range">
                                            <option>Upto $199</option>
                                            <option>Upto $250</option>
                                            <option>Upto $499</option>
                                            <option>Upto $599</option>
                                            <option>Upto $1000</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>Food Preference</label>
                                        <select class="form-control" name="hotel-food">
                                            <option>Indian</option>
                                            <option>Chineese</option>
                                            <option>Sea Food</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>Facilities</label>
                                        <select class="form-control" name="hotel-facilities">
                                            <option>WiFi</option>
                                            <option>Bar</option>
                                            <option>Restaurant</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>Rating</label>
                                        <select class="form-control" name="hotel-facilities">
                                            <option>5</option>
                                            <option>4</option>
                                            <option>3</option>
                                        </select>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 text-center">
                                        <button type="submit">SAVE CHANGES</button>
                                    </div>
                                </form>
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
        #profile{
            margin-buttom: 20px;
        }
    </style>
@endsection