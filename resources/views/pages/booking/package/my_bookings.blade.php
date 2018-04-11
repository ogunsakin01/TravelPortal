@extends('layouts.app')

@section('page-title')My Package Booking @endsection

@section('content')
    <div class="row booking-tab">
        <h3>My package Bookings </h3>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class=" table-responsive  dataTables_wrapper">
                        <table class="table dataTable ">
                            <thead>
                            <tr>
                                <th>Reference</th>
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
@endsection

@section('css')
    <style>
        .table thead{
            color: #f9676b;
        }
    </style>
@endsection