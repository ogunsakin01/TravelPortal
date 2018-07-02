@extends('layouts.backend')

@section('page-title') Hotel Booking Information  @endsection

@section('content')

    @php
        $user = \App\User::find($booking->user_id);
        $profile = \App\Profile::where('user_id',$booking->user_id)->first();
        $user['profile'] = $profile;
        $InterswitchConfig = new \App\Services\InterswitchConfig();
    @endphp

    <div class="row">
        <div class="col-md-4">
            @if($booking->payment_status == 0)
                @if(strtotime(date('y-m-d H:i:s')) < strtotime($booking->check_in_date))
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Payment Pending (Try Again)</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse">
                            <div class="card-body">
                                <p class="info"> Your payment is still pending for this booking, we will not be able to issue the ticket for this reservation until you make payment</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th>Pay with Interswitch</th>
                                            <td>
                                                <input  type="hidden"  class="booking_reference" value="{{$booking->reference}}"/>
                                                <form method="post" action="{{$InterswitchConfig->requestActionUrl}}">
                                                    <input  type="hidden"  class="reference" name="txn_ref" value=""/>
                                                    <input  type="hidden"  class="amount" name="amount" value="{{$booking->total_amount}}"/>
                                                    <input  type="hidden"  name="currency" value="566"/>
                                                    <input  type="hidden"  class="item_id" name="pay_item_id" value="{{$InterswitchConfig->item_id}}"/>
                                                    <input  type="hidden"  class="redirect_url" name="site_redirect_url" value=""/>
                                                    <input  type="hidden"  class="product_id" name="product_id" value="{{$InterswitchConfig->product_id}}"/>
                                                    <input  type="hidden"  class="cust_id" name="cust_id" value="{{$user->id}}"/>
                                                    <input  type="hidden"  name="cust_name" value="{{$profile->first_name}}"/>
                                                    <input  type="hidden"  class="hash" name="hash" value=""/>
                                                    <button type="button"  class="btn btn-primary btn-sm confirm_interswitch_booking"><i class="la la-lock"></i> CONFIRM BOOKING </button>
                                                    <button type="submit"  class="btn btn-primary btn-sm interswitch_pay_now hidden"><i class="la la-money"></i> PAY NOW</button>
                                                </form>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
            @if($booking->reservation_status == 0 && $booking->payment_status == 1)
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Incomplete Bookings (Try Again)</h4>
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
                                <p class="info">
                                Your payment was successful but we were unable to successful book the hotel room for you.
                                Please click on the button below to rebook the hotel room.<br/>
                                Note that customer information sent to the hotel will be information of current logged in user.
                                </p>
                                <div class="table-responsive">
                                    @if(strtotime(date('y-m-d H:i:s')) < strtotime($booking->check_in_date))
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <th>Try Again</th>
                                                <td>
                                                    <button type="button" class="btn btn-primary retry_booking" value="{{$booking->reference}}"><i class="la la-recycle"></i> Retry Booking</button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    @else
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <th class="danger"><i class="fa fa-times"></i> This reservation has expired !!!</th>
                                            </tr>
                                            </tbody>
                                        </table>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                @else
                <div class="alert alert-info">
                    <strong><i class="la la-info"></i> Important Notice !!!</strong>
                    <p>This reservation is still available, make payment for the reservation to go ahead with the booking.</p>
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Booking Information</h4>
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
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>PNR(Booking Code)</td>
                                    <th>{{$booking->pnr}}</th>
                                </tr>
                                <tr>
                                    <td>Reference</td>
                                    <td>{{$booking->reference}}</td>
                                </tr>
                                <tr>
                                    <td>Payment Status</td>
                                    <td>
                                        @if($booking->payment_status == 1)
                                            <b class="success"><i class="la la-check"></i> Paid</b>
                                        @elseif($booking->payment_status == 0)
                                            <b class="warning"><i class="la la-warning"></i> Pending</b>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Reservation Status</td>
                                    <td>
                                        @if($booking->reservation_status == 1)
                                            <b class="success"><i class="la la-check"></i> Reserved</b>
                                        @elseif($booking->reservation_status == 0)
                                            @if(strtotime(date('y-m-d H:i:s')) < strtotime($booking->check_in_date))
                                                <b class="warning"><i class="la la-warning"></i> Pending</b>
                                            @else
                                                <b class="danger"><i class="la la-times-circle-o"></i> Expired</b>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Cancellation Status</td>
                                    <td>
                                        @if($booking->cancellation_status == 1)
                                            <b class="success"><i class="la la-check"></i> Issued</b>
                                        @else
                                            @if(strtotime(date('y-m-d H:i:s')) < strtotime($booking->check_in_date))
                                                @if($booking->cancellation_status == 1)
                                                    <b class="danger"><i class="icon-shield"></i> Cancelled</b>
                                                @else
                                                    <b class="warning"><i class="la la-warning"></i> Pending</b>
                                                @endif
                                            @else
                                                @if($booking->cancellation_status == 1)
                                                    <b class="error"><i class="icon-shield"></i> Cancelled</b>
                                                @else
                                                    <b class="danger"><i class="la la-times-circle-o"></i> Expired</b>
                                                @endif
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Base Amount</td>
                                    <td> + &#x20a6;{{number_format(($booking->base_amount/100),2)}}</td>
                                </tr>
                                <tr>
                                    <td>Service Charge</td>
                                    <td> + &#x20a6;{{number_format(($booking->markup/100),2)}}</td>
                                </tr>
                                <tr>
                                    <td>Discount</td>
                                    <td> - &#x20a6;{{number_format(($booking->markdown/100),2)}}</td>
                                </tr>
                                <tr>
                                    <td>VAT</td>
                                    <td> + &#x20a6;{{number_format(($booking->vat/100),2)}}</td>
                                </tr>
                                <tr>
                                    <td>Voucher Amount</td>
                                    <td> - &#x20a6;{{number_format(($booking->voucher_amount/100),2)}}</td>
                                </tr>
                                <tr>
                                    <th>Total Amount Paid</th>
                                    <th> &#x20a6;{{number_format(($booking->total_amount/100),2)}}</th>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-8 col-md-offset">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Hotel Information</h4>
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
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table">
                                            <tr>
                                                <th>Hotel Name</th>
                                                <th>{{$booking->hotel_name}}</th>
                                            </tr>
                                            <tr>
                                                <th>Check In</th>
                                                <th>{{date('d,D M. Y',strtotime($booking->check_in_date))}}</th>
                                            </tr>
                                            <tr>
                                                <th>Check Out</th>
                                                <th>{{date('d,D M. Y',strtotime($booking->check_out_date))}}</th>
                                            </tr>
                                            <tr>
                                                <th>Guests</th>
                                                <th>{{$booking->adult_guest}} adult(s), {{$booking->child_guest}} child(s)</th>
                                            </tr>
                                            <tr>
                                                <th>Hotel City Code</th>
                                                <th>{{$booking->hotel_city_code}}</th>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection



@section('javascript')
    <script src="{{asset('backend/js/pages/payment_option.js')}}"></script>
    <script src="{{asset('backend/js/pages/hotel_booking_information.js')}}"></script>
@endsection

@section('css')

@endsection