@extends('layouts.app')

@section('page-title') My Flight Booking @endsection

@section('content')
    <div class="row booking-tab">
        <h3>My Flight Bookings </h3>
    </div>

    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class=" table-responsive dataTables_wrapper">
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
                            <tr>
                                <td>AIR-287-KLF-5a9822036b5e7</td>
                                <td>

                                    <strong>FVZFKP</strong>
                                </td>
                                <td data-toggle="tooltip" title="View flights information">
                                    <button class="btn btn-info" data-toggle="modal" data-target="#flight_information_AIR-287-KLF-5a9822036b5e7" ><i class="fa fa-plane"></i></button>
                                    <div class="modal fade" id="flight_information_AIR-287-KLF-5a9822036b5e7" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                                <a href="">Royal Air Maroc (04 hour(s) 30 minutes)</a>
                                                            </div>
                                                            <div class="url">
                                                                AT-0554  (BOEING 737-800 JET)
                                                            </div>
                                                            <div class="name">
                                                                <img src="http://pics.avs.io/200/200/AT.png" style="max-height: 70px; max-width: 250px;"/>
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
                                                                        <td>Thu, 29 Mar</td>
                                                                        <td>6:05 AM</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Arrival <i class="fa fa-plane fa-flip-vertical"></i></td>
                                                                        <td>Casablanca-Mohammed V, Morocco<br><small>CMN</small></td>
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
                                                                <a href="">Emirates Airlines (07 hour(s) 20 minutes)</a>
                                                            </div>
                                                            <div class="url">
                                                                EK-0752  (AIRBUS INDUSTRIE A380-800 JET 480-656)
                                                            </div>
                                                            <div class="name">
                                                                <img src="http://pics.avs.io/200/200/EK.png" style="max-height: 70px; max-width: 250px;"/>
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
                                                                        <td>Casablanca-Mohammed V, Morocco<br><small>CMN</small></td>
                                                                        <td>Thu, 29 Mar</td>
                                                                        <td>2:55 PM</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Arrival <i class="fa fa-plane fa-flip-vertical"></i></td>
                                                                        <td>Dubai-Dubai Intl, United Arab Emirates<br><small>DXB</small></td>
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
                                    <button class="btn btn-info" data-toggle="modal" data-target="#passenger_information_AIR-287-KLF-5a9822036b5e7" title="view flights information"><i class="fa fa-users"></i></button>
                                    <div class="modal fade" id="passenger_information_AIR-287-KLF-5a9822036b5e7" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                                <input class="form-control" disabled  value="IKE"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <input class="form-control" disabled value="CHINEDU"/>
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
                                    287,554.00
                                </td>
                                <td>
                                    3,000.00
                                </td>
                                <td>
                                    0.00
                                </td>
                                <td>
                                    290,554.00
                                </td>
                                <td>
                                    <span class="badge badge-danger"><i class="fa fa-warning"></i> Failed / Incomplete</span>
                                </td>
                                <td>
                                    <span class="badge badge-danger"><i class="fa fa-warning"></i> Failed</span>
                                </td>
                                <td>



                                </td>
                                <td>01, Thu Mar 2018, 15:53 PM</td>
                            </tr>
                            <tr>
                                <td>AIR-84-KLF-5a8d4f1a23da7</td>
                                <td>

                                    <strong>EHSFGU</strong>
                                </td>
                                <td data-toggle="tooltip" title="View flights information">
                                    <button class="btn btn-info" data-toggle="modal" data-target="#flight_information_AIR-84-KLF-5a8d4f1a23da7" ><i class="fa fa-plane"></i></button>
                                    <div class="modal fade" id="flight_information_AIR-84-KLF-5a8d4f1a23da7" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                                <a href="">Royal Brunei Airlines (06 hour(s) 55 minutes)</a>
                                                            </div>
                                                            <div class="url">
                                                                BI-0098  (787 BOEING 787 JET)
                                                            </div>
                                                            <div class="name">
                                                                <img src="http://pics.avs.io/200/200/BI.png" style="max-height: 70px; max-width: 250px;"/>
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
                                                                        <td>London-Heathrow, United Kingdom<br><small>LHR</small></td>
                                                                        <td>Tue, 27 Feb</td>
                                                                        <td>5:05 PM</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Arrival <i class="fa fa-plane fa-flip-vertical"></i></td>
                                                                        <td>Dubai-Dubai Intl, United Arab Emirates<br><small>DXB</small></td>
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
                                    <button class="btn btn-info" data-toggle="modal" data-target="#passenger_information_AIR-84-KLF-5a8d4f1a23da7" title="view flights information"><i class="fa fa-users"></i></button>
                                    <div class="modal fade" id="passenger_information_AIR-84-KLF-5a8d4f1a23da7" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                                <input class="form-control" disabled  value="OGUNSAKIN"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <input class="form-control" disabled value="DAMILOLA"/>
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
                                    803,336.00
                                </td>
                                <td>
                                    3,000.00
                                </td>
                                <td>
                                    0.00
                                </td>
                                <td>
                                    806,336.00
                                </td>
                                <td>
                                    <span class="badge badge-danger"><i class="fa fa-warning"></i> Failed / Incomplete</span>
                                </td>
                                <td>
                                    <span class="badge badge-danger"><i class="fa fa-warning"></i> Failed</span>
                                </td>
                                <td>



                                </td>
                                <td>21, Wed Feb 2018, 10:51 AM</td>
                            </tr>
                            <tr>
                                <td>AIR-226-KLF-5a8d4b9019606</td>
                                <td>

                                    <strong>MSIPEO</strong>
                                </td>
                                <td data-toggle="tooltip" title="View flights information">
                                    <button class="btn btn-info" data-toggle="modal" data-target="#flight_information_AIR-226-KLF-5a8d4b9019606" ><i class="fa fa-plane"></i></button>
                                    <div class="modal fade" id="flight_information_AIR-226-KLF-5a8d4b9019606" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                                <a href="">Rwandair Express (04 hour(s) 30 minutes)</a>
                                                            </div>
                                                            <div class="url">
                                                                WB-0203  (BOEING 737-800 JET)
                                                            </div>
                                                            <div class="name">
                                                                <img src="http://pics.avs.io/200/200/WB.png" style="max-height: 70px; max-width: 250px;"/>
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
                                                                        <td>Sat, 24 Feb</td>
                                                                        <td>3:35 PM</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Arrival <i class="fa fa-plane fa-flip-vertical"></i></td>
                                                                        <td>Kigali-International, Rwanda<br><small>KGL</small></td>
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
                                                                <a href="">Rwandair Express (00 hour(s) 49 minutes)</a>
                                                            </div>
                                                            <div class="url">
                                                                WB-0464  (CANADAIR REGIONAL JET)
                                                            </div>
                                                            <div class="name">
                                                                <img src="http://pics.avs.io/200/200/WB.png"/>
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
                                                                        <td>Kigali-International, Rwanda<br><small>KGL</small></td>
                                                                        <td>Sun, 25 Feb</td>
                                                                        <td>12:01 AM</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Arrival <i class="fa fa-plane fa-flip-vertical"></i></td>
                                                                        <td>Entebbe-Entebbe Intl, Uganda<br><small>EBB</small></td>
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
                                                                <a href="">Rwandair Express (01 hour(s) 20 minutes)</a>
                                                            </div>
                                                            <div class="url">
                                                                WB-0464  (CANADAIR REGIONAL JET)
                                                            </div>
                                                            <div class="name">
                                                                <img src="http://pics.avs.io/200/200/WB.png"/>
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
                                                                        <td>Entebbe-Entebbe Intl, Uganda<br><small>EBB</small></td>
                                                                        <td>Sun, 25 Feb</td>
                                                                        <td>2:40 AM</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Arrival <i class="fa fa-plane fa-flip-vertical"></i></td>
                                                                        <td>Nairobi-Jomo Kenyatta, Kenya<br><small>NBO</small></td>
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
                                                                <a href="">Rwandair Express (01 hour(s) 20 minutes)</a>
                                                            </div>
                                                            <div class="url">
                                                                WB-0465  (CANADAIR REGIONAL JET)
                                                            </div>
                                                            <div class="name">
                                                                <img src="http://pics.avs.io/200/200/WB.png"/>
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
                                                                        <td>Nairobi-Jomo Kenyatta, Kenya<br><small>NBO</small></td>
                                                                        <td>Wed, 28 Feb</td>
                                                                        <td>5:00 AM</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Arrival <i class="fa fa-plane fa-flip-vertical"></i></td>
                                                                        <td>Entebbe-Entebbe Intl, Uganda<br><small>EBB</small></td>
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
                                                                <a href="">Rwandair Express (01 hour(s) 00 minutes)</a>
                                                            </div>
                                                            <div class="url">
                                                                WB-0465  (CANADAIR REGIONAL JET)
                                                            </div>
                                                            <div class="name">
                                                                <img src="http://pics.avs.io/200/200/WB.png"/>
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
                                                                        <td>Entebbe-Entebbe Intl, Uganda<br><small>EBB</small></td>
                                                                        <td>Wed, 28 Feb</td>
                                                                        <td>7:00 AM</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Arrival <i class="fa fa-plane fa-flip-vertical"></i></td>
                                                                        <td>Kigali-International, Rwanda<br><small>KGL</small></td>
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
                                                                <a href="">Rwandair Express (04 hour(s) 30 minutes)</a>
                                                            </div>
                                                            <div class="url">
                                                                WB-0200  (AIRBUS INDUSTRIE A330 JET)
                                                            </div>
                                                            <div class="name">
                                                                <img src="http://pics.avs.io/200/200/WB.png" style="max-height: 70px; max-width: 250px;"/>
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
                                                                        <td>Kigali-International, Rwanda<br><small>KGL</small></td>
                                                                        <td>Wed, 28 Feb</td>
                                                                        <td>8:00 AM</td>
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
                                    <button class="btn btn-info" data-toggle="modal" data-target="#passenger_information_AIR-226-KLF-5a8d4b9019606" title="view flights information"><i class="fa fa-users"></i></button>
                                    <div class="modal fade" id="passenger_information_AIR-226-KLF-5a8d4b9019606" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                                <input class="form-control" disabled  value="OGUNSAKIN"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <input class="form-control" disabled value="DAMILOLA"/>
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
                                    204,282.00
                                </td>
                                <td>
                                    3,000.00
                                </td>
                                <td>
                                    0.00
                                </td>
                                <td>
                                    207,282.00
                                </td>
                                <td>
                                    <span class="badge badge-success"><i class="fa fa-success"></i> Success</span>
                                </td>
                                <td>
                                    <span class="badge badge-warning"><i class="fa fa-warning"></i> Pending</span>
                                </td>
                                <td>



                                </td>
                                <td>21, Wed Feb 2018, 10:36 AM</td>
                            </tr>
                            <tr>
                                <td>AIR-118-KLF-5a8c3ee500c0f</td>
                                <td>

                                    <strong>DGUPZG</strong>
                                </td>
                                <td data-toggle="tooltip" title="View flights information">
                                    <button class="btn btn-info" data-toggle="modal" data-target="#flight_information_AIR-118-KLF-5a8c3ee500c0f" ><i class="fa fa-plane"></i></button>
                                    <div class="modal fade" id="flight_information_AIR-118-KLF-5a8c3ee500c0f" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                                <a href="">Royal Brunei Airlines (06 hour(s) 55 minutes)</a>
                                                            </div>
                                                            <div class="url">
                                                                BI-0098  (787 BOEING 787 JET)
                                                            </div>
                                                            <div class="name">
                                                                <img src="http://pics.avs.io/200/200/BI.png" style="max-height: 70px; max-width: 250px;"/>
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
                                                                        <td>London-Heathrow, United Kingdom<br><small>LHR</small></td>
                                                                        <td>Fri, 23 Feb</td>
                                                                        <td>5:05 PM</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Arrival <i class="fa fa-plane fa-flip-vertical"></i></td>
                                                                        <td>Dubai-Dubai Intl, United Arab Emirates<br><small>DXB</small></td>
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
                                                                <a href="">Royal Brunei Airlines (07 hour(s) 50 minutes)</a>
                                                            </div>
                                                            <div class="url">
                                                                BI-0097  (787 BOEING 787 JET)
                                                            </div>
                                                            <div class="name">
                                                                <img src="http://pics.avs.io/200/200/BI.png" style="max-height: 70px; max-width: 250px;"/>
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
                                                                        <td>Dubai-Dubai Intl, United Arab Emirates<br><small>DXB</small></td>
                                                                        <td>Tue, 27 Feb</td>
                                                                        <td>3:00 AM</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Arrival <i class="fa fa-plane fa-flip-vertical"></i></td>
                                                                        <td>London-Heathrow, United Kingdom<br><small>LHR</small></td>
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
                                    <button class="btn btn-info" data-toggle="modal" data-target="#passenger_information_AIR-118-KLF-5a8c3ee500c0f" title="view flights information"><i class="fa fa-users"></i></button>
                                    <div class="modal fade" id="passenger_information_AIR-118-KLF-5a8c3ee500c0f" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                                <input class="form-control" disabled  value="ANIGBO"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <input class="form-control" disabled value="OLADIMEJI"/>
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
                                    1,150,009.00
                                </td>
                                <td>
                                    3,000.00
                                </td>
                                <td>
                                    0.00
                                </td>
                                <td>
                                    1,153,009.00
                                </td>
                                <td>
                                    <span class="badge badge-danger"><i class="fa fa-warning"></i> Failed / Incomplete</span>
                                </td>
                                <td>
                                    <span class="badge badge-danger"><i class="fa fa-warning"></i> Failed</span>
                                </td>
                                <td>



                                </td>
                                <td>20, Tue Feb 2018, 15:29 PM</td>
                            </tr>
                            <tr>
                                <td>AIR-183-KLF-5a8c3bb71cf22</td>
                                <td>

                                    <strong>ITLSQC</strong>
                                </td>
                                <td data-toggle="tooltip" title="View flights information">
                                    <button class="btn btn-info" data-toggle="modal" data-target="#flight_information_AIR-183-KLF-5a8c3bb71cf22" ><i class="fa fa-plane"></i></button>
                                    <div class="modal fade" id="flight_information_AIR-183-KLF-5a8c3bb71cf22" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                                <a href="">Royal Brunei Airlines (06 hour(s) 55 minutes)</a>
                                                            </div>
                                                            <div class="url">
                                                                BI-0098  (787 BOEING 787 JET)
                                                            </div>
                                                            <div class="name">
                                                                <img src="http://pics.avs.io/200/200/BI.png" style="max-height: 70px; max-width: 250px;"/>
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
                                                                        <td>London-Heathrow, United Kingdom<br><small>LHR</small></td>
                                                                        <td>Thu, 22 Feb</td>
                                                                        <td>5:05 PM</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Arrival <i class="fa fa-plane fa-flip-vertical"></i></td>
                                                                        <td>Dubai-Dubai Intl, United Arab Emirates<br><small>DXB</small></td>
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
                                                                <a href="">Royal Brunei Airlines (07 hour(s) 50 minutes)</a>
                                                            </div>
                                                            <div class="url">
                                                                BI-0097  (787 BOEING 787 JET)
                                                            </div>
                                                            <div class="name">
                                                                <img src="http://pics.avs.io/200/200/BI.png" style="max-height: 70px; max-width: 250px;"/>
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
                                                                        <td>Dubai-Dubai Intl, United Arab Emirates<br><small>DXB</small></td>
                                                                        <td>Wed, 28 Feb</td>
                                                                        <td>3:00 AM</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Arrival <i class="fa fa-plane fa-flip-vertical"></i></td>
                                                                        <td>London-Heathrow, United Kingdom<br><small>LHR</small></td>
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
                                    <button class="btn btn-info" data-toggle="modal" data-target="#passenger_information_AIR-183-KLF-5a8c3bb71cf22" title="view flights information"><i class="fa fa-users"></i></button>
                                    <div class="modal fade" id="passenger_information_AIR-183-KLF-5a8c3bb71cf22" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                                <input class="form-control" disabled  value="DANIEL"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <input class="form-control" disabled value="OLADIMEJI"/>
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
                                    1,150,009.00
                                </td>
                                <td>
                                    3,000.00
                                </td>
                                <td>
                                    0.00
                                </td>
                                <td>
                                    1,153,009.00
                                </td>
                                <td>
                                    <span class="badge badge-danger"><i class="fa fa-warning"></i> Failed / Incomplete</span>
                                </td>
                                <td>
                                    <span class="badge badge-danger"><i class="fa fa-warning"></i> Failed</span>
                                </td>
                                <td>



                                </td>
                                <td>20, Tue Feb 2018, 15:16 PM</td>
                            </tr>
                            <tr>
                                <td>AIR-188-KLF-5a8c37a43864b</td>
                                <td>

                                    <strong>LMEZBO</strong>
                                </td>
                                <td data-toggle="tooltip" title="View flights information">
                                    <button class="btn btn-info" data-toggle="modal" data-target="#flight_information_AIR-188-KLF-5a8c37a43864b" ><i class="fa fa-plane"></i></button>
                                    <div class="modal fade" id="flight_information_AIR-188-KLF-5a8c37a43864b" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                                <a href="">Royal Brunei Airlines (06 hour(s) 55 minutes)</a>
                                                            </div>
                                                            <div class="url">
                                                                BI-0098  (787 BOEING 787 JET)
                                                            </div>
                                                            <div class="name">
                                                                <img src="http://pics.avs.io/200/200/BI.png" style="max-height: 70px; max-width: 250px;"/>
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
                                                                        <td>London-Heathrow, United Kingdom<br><small>LHR</small></td>
                                                                        <td>Thu, 22 Feb</td>
                                                                        <td>5:05 PM</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Arrival <i class="fa fa-plane fa-flip-vertical"></i></td>
                                                                        <td>Dubai-Dubai Intl, United Arab Emirates<br><small>DXB</small></td>
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
                                                                <a href="">Royal Brunei Airlines (07 hour(s) 50 minutes)</a>
                                                            </div>
                                                            <div class="url">
                                                                BI-0097  (787 BOEING 787 JET)
                                                            </div>
                                                            <div class="name">
                                                                <img src="http://pics.avs.io/200/200/BI.png" style="max-height: 70px; max-width: 250px;"/>
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
                                                                        <td>Dubai-Dubai Intl, United Arab Emirates<br><small>DXB</small></td>
                                                                        <td>Thu, 01 Mar</td>
                                                                        <td>3:00 AM</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Arrival <i class="fa fa-plane fa-flip-vertical"></i></td>
                                                                        <td>London-Heathrow, United Kingdom<br><small>LHR</small></td>
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
                                    <button class="btn btn-info" data-toggle="modal" data-target="#passenger_information_AIR-188-KLF-5a8c37a43864b" title="view flights information"><i class="fa fa-users"></i></button>
                                    <div class="modal fade" id="passenger_information_AIR-188-KLF-5a8c37a43864b" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                                <input class="form-control" disabled  value="DANIEL"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <input class="form-control" disabled value="OLADIMEJI"/>
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
                                    1,150,009.00
                                </td>
                                <td>
                                    3,000.00
                                </td>
                                <td>
                                    0.00
                                </td>
                                <td>
                                    1,153,009.00
                                </td>
                                <td>
                                    <span class="badge badge-danger"><i class="fa fa-warning"></i> Failed / Incomplete</span>
                                </td>
                                <td>
                                    <span class="badge badge-danger"><i class="fa fa-warning"></i> Failed</span>
                                </td>
                                <td>



                                </td>
                                <td>20, Tue Feb 2018, 14:58 PM</td>
                            </tr>
                            <tr>
                                <td>AIR-631-KLF-5a8c2ca136b7e</td>
                                <td>

                                    <strong>ISOFXM</strong>
                                </td>
                                <td data-toggle="tooltip" title="View flights information">
                                    <button class="btn btn-info" data-toggle="modal" data-target="#flight_information_AIR-631-KLF-5a8c2ca136b7e" ><i class="fa fa-plane"></i></button>
                                    <div class="modal fade" id="flight_information_AIR-631-KLF-5a8c2ca136b7e" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                                <a href="">Royal Brunei Airlines (06 hour(s) 55 minutes)</a>
                                                            </div>
                                                            <div class="url">
                                                                BI-0098  (787 BOEING 787 JET)
                                                            </div>
                                                            <div class="name">
                                                                <img src="http://pics.avs.io/200/200/BI.png" style="max-height: 70px; max-width: 250px;"/>
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
                                                                        <td>London-Heathrow, United Kingdom<br><small>LHR</small></td>
                                                                        <td>Mon, 26 Feb</td>
                                                                        <td>5:05 PM</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Arrival <i class="fa fa-plane fa-flip-vertical"></i></td>
                                                                        <td>Dubai-Dubai Intl, United Arab Emirates<br><small>DXB</small></td>
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
                                                                <a href="">Royal Brunei Airlines (07 hour(s) 50 minutes)</a>
                                                            </div>
                                                            <div class="url">
                                                                BI-0097  (787 BOEING 787 JET)
                                                            </div>
                                                            <div class="name">
                                                                <img src="http://pics.avs.io/200/200/BI.png" style="max-height: 70px; max-width: 250px;"/>
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
                                                                        <td>Dubai-Dubai Intl, United Arab Emirates<br><small>DXB</small></td>
                                                                        <td>Sat, 10 Mar</td>
                                                                        <td>3:00 AM</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Arrival <i class="fa fa-plane fa-flip-vertical"></i></td>
                                                                        <td>London-Heathrow, United Kingdom<br><small>LHR</small></td>
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
                                    <button class="btn btn-info" data-toggle="modal" data-target="#passenger_information_AIR-631-KLF-5a8c2ca136b7e" title="view flights information"><i class="fa fa-users"></i></button>
                                    <div class="modal fade" id="passenger_information_AIR-631-KLF-5a8c2ca136b7e" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                                <input class="form-control" disabled  value="ANENU"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <input class="form-control" disabled value="CHARLES"/>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <hr/>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h5>
                                                                CHILD <small>2 - 12 years old</small>
                                                            </h5>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <input class="form-control" disabled  value="ANENU"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <input class="form-control" disabled value="DANIEL"/>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <hr/>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h5>
                                                                INFANT <small>below 2 years old</small>
                                                            </h5>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <input class="form-control" disabled  value="ANENU"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <input class="form-control" disabled value="GLORY"/>
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
                                    2,136,407.00
                                </td>
                                <td>
                                    3,000.00
                                </td>
                                <td>
                                    0.00
                                </td>
                                <td>
                                    2,139,407.00
                                </td>
                                <td>
                                    <span class="badge badge-danger"><i class="fa fa-warning"></i> Failed / Incomplete</span>
                                </td>
                                <td>
                                    <span class="badge badge-danger"><i class="fa fa-warning"></i> Failed</span>
                                </td>
                                <td>



                                </td>
                                <td>20, Tue Feb 2018, 14:11 PM</td>
                            </tr>
                            <tr>
                                <td>AIR-177-KLF-5a8ae57ed179a</td>
                                <td>

                                    <strong>HHNPSA</strong>
                                </td>
                                <td data-toggle="tooltip" title="View flights information">
                                    <button class="btn btn-info" data-toggle="modal" data-target="#flight_information_AIR-177-KLF-5a8ae57ed179a" ><i class="fa fa-plane"></i></button>
                                    <div class="modal fade" id="flight_information_AIR-177-KLF-5a8ae57ed179a" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                                <a href="">Rwandair Express (01 hour(s) 00 minutes)</a>
                                                            </div>
                                                            <div class="url">
                                                                WB-0200  (AIRBUS INDUSTRIE A330 JET)
                                                            </div>
                                                            <div class="name">
                                                                <img src="http://pics.avs.io/200/200/WB.png" style="max-height: 70px; max-width: 250px;"/>
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
                                                                        <td>Mon, 30 Jul</td>
                                                                        <td>12:20 PM</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Arrival <i class="fa fa-plane fa-flip-vertical"></i></td>
                                                                        <td>Accra-Kotoka Intl, Ghana<br><small>ACC</small></td>
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
                                                                <a href="">Rwandair Express (01 hour(s) 00 minutes)</a>
                                                            </div>
                                                            <div class="url">
                                                                WB-0201  (AIRBUS INDUSTRIE A330 JET)
                                                            </div>
                                                            <div class="name">
                                                                <img src="http://pics.avs.io/200/200/WB.png" style="max-height: 70px; max-width: 250px;"/>
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
                                                                        <td>Accra-Kotoka Intl, Ghana<br><small>ACC</small></td>
                                                                        <td>Wed, 15 Aug</td>
                                                                        <td>1:10 PM</td>
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
                                    <button class="btn btn-info" data-toggle="modal" data-target="#passenger_information_AIR-177-KLF-5a8ae57ed179a" title="view flights information"><i class="fa fa-users"></i></button>
                                    <div class="modal fade" id="passenger_information_AIR-177-KLF-5a8ae57ed179a" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                                <input class="form-control" disabled  value="JOHN"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <input class="form-control" disabled value="DOE"/>
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
                                    137,637.00
                                </td>
                                <td>
                                    3,000.00
                                </td>
                                <td>
                                    0.00
                                </td>
                                <td>
                                    140,637.00
                                </td>
                                <td>
                                    <span class="badge badge-danger"><i class="fa fa-warning"></i> Failed / Incomplete</span>
                                </td>
                                <td>
                                    <span class="badge badge-danger"><i class="fa fa-warning"></i> Failed</span>
                                </td>
                                <td>



                                </td>
                                <td>19, Mon Feb 2018, 14:55 PM</td>
                            </tr>
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
    </style>
@endsection