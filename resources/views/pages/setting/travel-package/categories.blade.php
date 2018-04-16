@extends('layouts.app')

@section('page-title') Travel-package Categories @endsection

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
                        <li class="active"><a  href="{{ url('setting/travel-package/categories') }}" class="text-center"><i class="fa fa-list"></i> <span>Categories</span></a></li>
                        <li ><a href="{{ url('setting/travel-package/create') }}" class="text-center"><i class="fa fa-plus"></i> <span>Create Package</span></a></li>
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