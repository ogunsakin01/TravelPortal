@extends('layouts.backend')

@section('page-title') Customers Hotel Bookings  @endsection



@section('content')

    {{--@php  $cancelledBookingsPercentage = $cancelledBookings/count($bookings) *100 @endphp--}}
    {{--@php  $paidSuccessfulBookingsPercentage = $paidSuccessfulBookings/count($bookings) *100 @endphp--}}
    {{--@php  $paidUnsuccessfulBookingsPercentage = $paidUnsuccessfulBookings/count($bookings) *100 @endphp--}}
    {{--@php  $failedBookingsPercentage = $failedBookings/count($bookings) *100 @endphp--}}

    <div class="row">

        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="info">{{count($customerBookings)}}</h3>
                                <h6>Reservations Attempts</h6>
                            </div>
                            <div>
                                <i class="icon-home info font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
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
                                <h3 class="primary">{{number_format($paidSuccessfulBookings)}}</h3>
                                <h6>Payed Successful Reservations</h6>
                            </div>
                            <div>
                                <i class="icon-check primary font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-primary" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
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
                                <h3 class="warning">{{number_format($paidUnsuccessfulBookings)}}</h3>
                                <h6>Payed Unsuccessful Reservations</h6>
                            </div>
                            <div>
                                <i class="icon-fire warning font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
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
                                <h3 class="danger">{{number_format($failedBookings)}}</h3>
                                <h6>Failed Reservations</h6>
                            </div>
                            <div>
                                <i class="icon-shield danger font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
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
                                <h3 class="danger">{{number_format($cancelledBookings)}}</h3>
                                <h6>Cancelled Reservations</h6>
                            </div>
                            <div>
                                <i class="icon-close danger font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width:85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
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
                    <h4 class="card-title">Customers Hotel Reservations</h4>
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
                        <table class="table table-striped table-responsive table-bordered">
                            <thead>
                            <tr>
                                <th>Reference</th>
                                <th>PNR(Booking Code)</th>
                                <th>Customer Name</th>
                                <th>Hotel Name</th>
                                <th>Due Date</th>
                                <th>Payment Status</th>
                                <th>Reservation Status</th>
                                <th>Cancellation Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customerBookings as $serial => $booking)
                                <tr>
                                    <td>{{$booking->reference}}</td>
                                    <td>{{$booking->pnr}}</td>
                                    <td>{{\App\Profile::where('user_id',$booking->user_id)->first()->sur_name}}
                                        {{\App\Profile::where('user_id',$booking->user_id)->first()->first_name}}
                                    </td>
                                    <td>{{$booking->hotel_name}}</td>
                                    <td>{{$booking->check_in_date}}</td>
                                    <td>
                                        @if($booking->payment_status == 1)
                                            <p class="success"><i class="la la-check"></i> Successful</p>
                                        @elseif($booking->payment_status == 0)
                                            <p class="warning"><i class="la la-warning"></i> Incomplete</p>
                                        @endif
                                    </td>
                                    <td>
                                        @if($booking->reservation_status == 1)
                                            <p class="success"><i class="la la-check"></i> Successful</p>
                                        @elseif($booking->reservation_status == 0)
                                            <p class="warning"><i class="la la-warning"></i> Incomplete</p>
                                        @endif
                                    </td>
                                    <td class="cancel_status_">
                                        @if($booking->cancellation_status == 1)
                                            <p class="success"><i class="la la-check"></i> Successful</p>
                                        @elseif($booking->cancellation_status == 0)
                                            <p class="warning"><i class="la la-warning"></i> Incomplete</p>
                                        @endif
                                    </td>
                                    <td>
                                      <span class="dropdown">
				                        <button id="btnSearchDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
				                        <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">
				                            <a href="{{url('bookings/hotel/hotel-reservation-information/'.$booking->reference)}}" class="dropdown-item"><i class="la la-eye"></i> View</a>
                                            @if(strtotime(date('y-m-d H:i:s')) < strtotime($booking->check_in_date))
                                                @if($booking->cancel_ticket_status == 0)
                                                    <button class="dropdown-item btn cancel_pnr" value="{{$booking->pnr}}"><i class="la la-times-circle"></i> Cancel</button>
                                                @endif
                                            @else
                                                <button class="dropdown-item btn cancel_pnr" value="{{$booking->pnr}}"><i class="la la-times-circle"></i> Cancel</button>
                                            @endif
				                        </span>
				                    </span>
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
    <script src="{{asset('backend/js/pages/bookings_management.js')}}"></script>
@endsection

@section('css')

@endsection