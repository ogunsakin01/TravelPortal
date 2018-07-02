@extends('layouts.backend')

@section('page-title')  Dashboard  @endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert round bg-success alert-icon-left alert-arrow-left alert-dismissible mb-2" role="alert">
                    <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Great !!! </strong> {{ session('status') }}
                </div>
            @endif
            @if($errors->any())
                @foreach($errors->all() as $serial => $error)
                    <div class="alert round bg-danger alert-icon-left alert-arrow-left alert-dismissible mb-2" role="alert">
                        <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <strong>Oh snap!</strong> {{$error}}
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    @role('admin')

    <div class="row">
        <div class="col-xl-12 col-12">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class="text-muted">Successful Flight Bookings</h6>
                                        <h3>&#x20A6;{{number_format(($generalSuccessfulFlightBookingPrice/100),2)}}</h3>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="icon-plane primary font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class="text-muted">Successful Hotel Bookings</h6>
                                        <h3>&#x20A6;{{number_format(($generalSuccessfulHotelBookingPrice/100),2)}}</h3>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="icon-home primary font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class="text-muted">Successful Package Bookings </h6>
                                        <h3>&#x20A6;{{number_format(($generalSuccessfulPackageBookingPrice/100),2)}}</h3>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="icon-bag primary font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
       <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-center">Booking Size</h4>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-md-4 col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                <h4 class="font-large-2 text-bold-400">{{number_format($generalTotalFlightBookings)}}</h4>
                                <p class="blue-grey lighten-2 mb-0">Flight</p>
                            </div>
                            <div class="col-md-4 col-12 border-right-blue-grey border-right-lighten-5 text-center ">
                                <h4 class="font-large-2 text-bold-400">{{number_format($generalTotalHotelBookings)}}</h4>
                                <p class="blue-grey lighten-2 mb-0">Hotel</p>
                            </div>
                            <div class="col-md-4 col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                <h4 class="font-large-2 text-bold-400">{{number_format($generalTotalPackageBookings)}}</h4>
                                <p class="blue-grey lighten-2 mb-0">Packages</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Visa Applications</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered file-export">
                                <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Surname</th>
                                    <th>Given name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Residence Country</th>
                                    <th>Destination Country</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($visaApplications as $serial => $visaApplication)
                                    <tr>
                                        <td>{{$serial}}</td>
                                        <td>{{$visaApplication->surname}}</td>
                                        <td>{{$visaApplication->given_name}}</td>
                                        <td>{{$visaApplication->email}}</td>
                                        <td>{{$visaApplication->phone}}</td>
                                        <td>{{$visaApplication->residence_country}}</td>
                                        <td>{{$visaApplication->destination_country}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endrole

    @role('customer')

    <div class="row">
        <div class="col-xl-12 col-12">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class="text-muted">Successful Flight Bookings</h6>
                                        <h3>&#x20A6;{{number_format(($userGeneralSuccessfulFlightBookingPrice/100),2)}}</h3>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="icon-plane primary font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class="text-muted">Successful Hotel Bookings</h6>
                                        <h3>&#x20A6;{{number_format(($userGeneralSuccessfulHotelBookingPrice/100),2)}}</h3>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="icon-home primary font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class="text-muted">Successful Package Bookings </h6>
                                        <h3>&#x20A6;{{number_format(($userGeneralSuccessfulPackageBookingPrice/100),2)}}</h3>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="icon-bag primary font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-center">Booking Size</h4>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-md-4 col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                <h4 class="font-large-2 text-bold-400">{{number_format($userGeneralTotalFlightBookings)}}</h4>
                                <p class="blue-grey lighten-2 mb-0">Flight</p>
                            </div>
                            <div class="col-md-4 col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                <h4 class="font-large-2 text-bold-400">{{number_format($userGeneralTotalHotelBookings)}}</h4>
                                <p class="blue-grey lighten-2 mb-0">Hotel</p>
                            </div>
                            <div class="col-md-4 col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                <h4 class="font-large-2 text-bold-400">{{number_format($userGeneralTotalPackageBookings)}}</h4>
                                <p class="blue-grey lighten-2 mb-0">Packages</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endrole

    @role('agent')

    <div class="row">
        <div class="col-xl-12 col-12">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class="text-muted">Successful Flight Bookings</h6>
                                        <h3>&#x20A6;{{number_format(($userGeneralSuccessfulFlightBookingPrice/100),2)}}</h3>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="icon-plane primary font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class="text-muted">Successful Hotel Bookings</h6>
                                        <h3>&#x20A6;{{number_format(($userGeneralSuccessfulHotelBookingPrice/100),2)}}</h3>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="icon-home primary font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h6 class="text-muted">Successful Package Bookings </h6>
                                        <h3>&#x20A6;{{number_format(($userGeneralSuccessfulPackageBookingPrice/100),2)}}</h3>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="icon-bag primary font-large-2 float-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-center">Booking Size</h4>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-md-4 col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                <h4 class="font-large-2 text-bold-400">{{number_format($userGeneralTotalFlightBookings)}}</h4>
                                <p class="blue-grey lighten-2 mb-0">Flight</p>
                            </div>
                            <div class="col-md-4 col-12 text-center border-right-blue-grey border-right-lighten-5">
                                <h4 class="font-large-2 text-bold-400">{{number_format($userGeneralTotalHotelBookings)}}</h4>
                                <p class="blue-grey lighten-2 mb-0">Hotel</p>
                            </div>
                            <div class="col-md-4 col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                <h4 class="font-large-2 text-bold-400">{{number_format($userGeneralTotalPackageBookings)}}</h4>
                                <p class="blue-grey lighten-2 mb-0">Packages</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endrole

@endsection





@section('javascript')
    <script src="{{asset('backend/app-assets/js/scripts/pages/dashboard-sales.min.js')}}" type="text/javascript"></script>
@endsection
