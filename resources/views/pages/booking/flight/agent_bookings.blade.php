@extends('layouts.app')

@section('page-title') Package List @endsection

@section('content')
    <div class="row booking-tab">
        <h3>Agent Flight Bookings </h3>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive dataTables_wrapper">
                        <table class="table dataTable ">
                            <thead>
                                <tr>
                                    <th>Reference</th>
                                    <th>PNR</th>
                                    <th>Flights</th>
                                    <th>Passengers</th>
                                    <th>Base Price (₦)</th>
                                    <th>Taxes (₦)</th>
                                    <th>Discount (₦)</th>
                                    <th>Amount Paid (₦)</th>
                                    <th>Deadline</th>
                                    <th>Payment Status</th>
                                    <th>Ticket Status</th>
                                    <th>Actions</th>
                                    <th>Booked On</th>
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