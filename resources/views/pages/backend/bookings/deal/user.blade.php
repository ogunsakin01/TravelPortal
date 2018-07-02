@extends('layouts.backend')

@section('page-title') Bookings  @endsection

@section('content')

    <div class="row">
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="info">{{number_format(count($userBookings))}}</h3>
                                <h6>Attempted Bookings</h6>
                            </div>
                            <div>
                                <i class="icon-briefcase info font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="success">{{number_format($paidBookings)}}</h3>
                                <h6>Paid Bookings</h6>
                            </div>
                            <div>
                                <i class="icon-check success font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="warning">{{number_format($pendingBookings)}}</h3>
                                <h6>Pending/Failed Bookings</h6>
                            </div>
                            <div>
                                <i class="icon-close warning font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
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
                    <h4 class="card-title">Deal Bookings</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-responsive table-bordered file-export">
                            <thead>
                            <tr>
                                <th>(S/N)</th>
                                <th>Reference</th>
                                <th>Deal Name</th>
                                <th>Adults</th>
                                <th>Children</th>
                                <th>Infants</th>
                                <th>Amount Paid</th>
                                <th>Payment Status</th>
                                <th>Date Booked</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($userBookings as $serial => $userBooking)
                                <tr>
                                    <td>{{$serial+1}}</td>
                                    <td>{{$userBooking->reference}}</td>
                                    <td>{{$userBooking->deal->name}}</td>
                                    <td>{{$userBooking->adults}}</td>
                                    <td>{{$userBooking->children}}</td>
                                    <td>{{$userBooking->infants}}</td>
                                    <td>&#x20a6;{{number_format(($userBooking->total_amount/100),2)}}</td>
                                    <td>
                                        @if($userBooking->payment_status == 1)
                                            <p class="success"><i class="la la-check"></i> Success</p>
                                        @elseif($userBooking->payment_status == 0)
                                            <p class="warning"><i class="la la-warning"></i> Pending</p>
                                        @endif
                                    </td>
                                    <td>
                                        {{date('D d,M. Y. H:i:s',strtotime($userBooking->created_at))}}
                                    </td>
                                    <td>
                                        <a href="{{url('/booking/package/package-reservation-information/'.$userBooking->reference)}}" class="btn btn-primary"> <i class="la la-eye"></i> View</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection



@section('javascript')
    <script src="{{asset('backend/js/pages/deals_booking_management.js')}}"></script>
@endsection
