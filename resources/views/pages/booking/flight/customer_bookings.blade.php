@extends('layouts.app')

@section('page-title') Customer Booking @endsection

@section('content')
    <div class="row booking-tab">
        <h3>Customer Flight Bookings </h3>
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
                                <tr>
                                    <td>AIR-475-KLF-5aa7b059d95e2</td>
                                    <td>

                                        <strong>GRMGVX</strong>
                                    </td>
                                    <td data-toggle="tooltip" title="View flights information">
                                        <button class="btn btn-info" data-toggle="modal" data-target="#flight_information_AIR-475-KLF-5aa7b059d95e2" ><i class="fa fa-plane"></i></button>
                                        <div class="modal fade" id="flight_information_AIR-475-KLF-5aa7b059d95e2" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content modal-lt ">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Flight(s) Information  -  <strong>2018</strong></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">



                                                        <ul class="external-searchlist" style="max-width: 770px;">
                                                            <li>
                                                                <div class="name">
                                                                    <a href="">Lufthansa (06 hour(s) 25 minutes)</a>
                                                                </div>
                                                                <div class="url">
                                                                    LH-0569  (AIRBUS INDUSTRIE A330-300 JET)
                                                                </div>
                                                                <div class="name">
                                                                    <img src="http://pics.avs.io/200/200/LH.png" style="max-height: 70px; max-width: 250px;"/>
                                                                </div>
                                                                <div class="desc">
                                                                    <table class="table table-striped">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>Departure/ Arrival</th>
                                                                            <th>Airport/City</th>
                                                                            <th>Date</th>
                                                                            <th>Time</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <tr>
                                                                            <td>Departure <i class="fa fa-plane"></i></td>
                                                                            <td>Lagos-Murtala Muhammed Intl, Nigeria<br><small>LOS</small></td>
                                                                            <td>Tue, 04 Sep</td>
                                                                            <td>10:35 PM</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Arrival <i class="fa fa-plane fa-flip-vertical"></i></td>
                                                                            <td>Frankfurt-Frankfurt Intl, Germany<br><small>FRA</small></td>
                                                                            <td>Thu, 01 Jan</td>
                                                                            <td>12:00 AM</td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>

                                                            </li>
                                                        </ul>



                                                        <ul class="external-searchlist" style="max-width: 770px;">
                                                            <li>
                                                                <div class="name">
                                                                    <a href="">Lufthansa (06 hour(s) 25 minutes)</a>
                                                                </div>
                                                                <div class="url">
                                                                    LH-0568  (AIRBUS INDUSTRIE A330-300 JET)
                                                                </div>
                                                                <div class="name">
                                                                    <img src="http://pics.avs.io/200/200/LH.png" style="max-height: 70px; max-width: 250px;"/>
                                                                </div>
                                                                <div class="desc">
                                                                    <table class="table table-striped">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>Departure/ Arrival</th>
                                                                            <th>Airport/City</th>
                                                                            <th>Date</th>
                                                                            <th>Time</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <tr>
                                                                            <td>Departure <i class="fa fa-plane"></i></td>
                                                                            <td>Frankfurt-Frankfurt Intl, Germany<br><small>FRA</small></td>
                                                                            <td>Tue, 11 Sep</td>
                                                                            <td>11:10 AM</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Arrival <i class="fa fa-plane fa-flip-vertical"></i></td>
                                                                            <td>Lagos-Murtala Muhammed Intl, Nigeria<br><small>LOS</small></td>
                                                                            <td>Thu, 01 Jan</td>
                                                                            <td>12:00 AM</td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>

                                                            </li>
                                                        </ul>



                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-toggle="tooltip" title="View passengers details">
                                        <button class="btn btn-info" data-toggle="modal" data-target="#passenger_information_AIR-475-KLF-5aa7b059d95e2" title="view flights information"><i class="fa fa-users"></i></button>
                                        <div class="modal fade" id="passenger_information_AIR-475-KLF-5aa7b059d95e2" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content modal-lt ">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Passenger(s) Information</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h5>
                                                                    ADULT <small>above 12 years old</small>
                                                                </h5>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="form-group">
                                                                    <input class="form-control" disabled  value="ATRIB"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="form-group">
                                                                    <input class="form-control" disabled value="ELIAS"/>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <hr/>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h5>
                                                                    ADULT <small>above 12 years old</small>
                                                                </h5>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="form-group">
                                                                    <input class="form-control" disabled  value="ATRIB"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="form-group">
                                                                    <input class="form-control" disabled value="FLEURDELIZ"/>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <hr/>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        2,649,978.00
                                    </td>
                                    <td>
                                        3,000.00
                                    </td>
                                    <td>
                                        0.00
                                    </td>
                                    <td>
                                        2,652,978.00
                                    </td>
                                    <td>
                                        <span class="badge badge-danger"><i class="fa fa-warning"></i> Failed / Incomplete</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-danger"><i class="fa fa-warning"></i> Failed</span>
                                    </td>
                                    <td>



                                    </td>
                                    <td>13, Tue Mar 2018, 11:04 AM</td>
                                </tr>
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