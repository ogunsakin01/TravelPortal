@extends('layouts.app')

@section('page-title')Agent Package Booking @endsection

@section('content')
    <div class="content">

        <div class="row">
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card stats-card">
                            <div class="stats-icon">
                                <span class="fa fa-check-circle"></span>
                            </div>
                            <div class="stats-ctn">
                                <div class="stats-counter"><span class="counter">0</span></div>
                                <span class="desc">Successful Bookings <span class="badge badge-success">successful</span> </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card stats-card">
                            <div class="stats-icon">
                                <span class="fa fa-times-circle"></span>
                            </div>
                            <div class="stats-ctn">
                                <div class="stats-counter"><span class="counter">0</span></div>
                                <span class="desc">Failed Bookings <span class="badge badge-danger">failed/Incomplete</span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        Agents Package Bookings
                    </div>
                    <div class="card-body">
                        <div class=" table-responsive  dataTables_wrapper">
                            <table class="table dataTable ">
                                <thead>
                                <tr>
                                    <th>Reference</th>
                                    <th>Agency Name</th>
                                    <th>Agent Id</th>
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
        </div>

    </div>
@endsection

@section('css')
    <style>
        .table thead{
            color: #f9676b;
        }

        .card.stats-card .stats-icon {
            position: absolute;
            height: 100%;
            top: 0;
            left: 0;
            width: 75px;
            background-color: #efefef;
            font-size: 35px;
            text-align: center;
            color: #aaa;
            line-height: 2.9;
        }
    </style>
@endsection