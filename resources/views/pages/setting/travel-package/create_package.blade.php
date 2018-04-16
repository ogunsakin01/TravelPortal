@extends('layouts.app')

@section('page-title')Create Travel-package @endsection

@section('content')
    <div class="row user-profile">
        <div class="container">
            <div class="col-md-12 user-name">
                <h3>Travel Package</h3>
            </div>
            <div class="col-md-2 col-sm-2">
                <div class="user-profile-tabs">
                    <ul class="nav nav-tabs">
                        <li ><a  href="{{ url('setting/travel-package') }}" class="text-center"><i class="fa fa-th"></i> <span>All Travel Packages</span></a></li>
                        <li><a  href="{{ url('setting/travel-package/categories') }}" class="text-center"><i class="fa fa-list"></i> <span>Categories</span></a></li>
                        <li class="active"><a href="{{ url('setting/travel-package/create') }}" class="text-center"><i class="fa fa-plus"></i> <span>Create Package</span></a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-10 col-sm-10">
                <div class="tab-content">
                    <div class="booking-tab">
                        <h3>Create Travel Package </h3>
                    </div>

                        <div class="col-md-12">
                            <div class="recent-complaint">
                                <div class="submit-complaint">
                                    <form >
                                        <h4>Package Options <small>Select at least one</small></h4>
                                        <div class="col-md-4 col-sm-4 col-xs-4">
                                                <lable>&nbsp;</lable>
                                                <input type="checkbox" name="" > Flight
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-4">
                                            <lable>&nbsp;</lable>
                                            <input type="checkbox" > Hotel
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-4">
                                            <lable>&nbsp;</lable>
                                            <input type="checkbox" > Attraction
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <label>Category</label>
                                            <select class="form-control" name="category">
                                                <option>Flight</option>
                                                <option>Hotel</option>
                                                <option>Cruise</option>
                                                <option>Holiday</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <label>Sub Category</label>
                                            <select class="form-control" name="sub-category">
                                                <option>Flight</option>
                                                <option>Hotel</option>
                                                <option>Cruise</option>
                                                <option>Holiday</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Booking ID</label>
                                            <input type="text" class="form-control" name="booking-id" placeholder="e.g. CR12567">
                                        </div>
                                        <div class="col-md-12">
                                            <label>Subject</label>
                                            <input type="text" class="form-control" name="subject" placeholder="Problem Subject">
                                        </div>
                                        <div class="col-md-12">
                                            <label>Problem Description</label>
                                            <textarea class="form-control" rows="5" name="problem" placeholder="Your Issue"></textarea>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <button type="submit">SUBMIT REQUEST</button>
                                        </div>
                                    </form>
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
    </style>
@endsection