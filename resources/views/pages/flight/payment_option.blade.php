@extends('layouts.app')

@section('page-title') Flight Result  @endsection

@section('content')
    @php
        $AmadeusConfig = new \App\Services\AmadeusConfig();
        $AmadeusHelper = new \App\Services\AmadeusHelper();
    @endphp

    <!-- START: PAGE TITLE -->
    <div class="row page-title">
        <div class="container clear-padding text-center flight-title">
            <h3>Your Booking</h3>
            @foreach($flightSearchParam['flight_search'] as $i => $searchParam)
                <h5><i class="fa fa-plane"></i>{{$searchParam['departure_city']}}<i class="fa fa-long-arrow-right"></i>{{$searchParam['destination_city']}}</h5>
            @endforeach
            <span> <i class="fa fa-male"></i>Traveller(s) - {{$flightSearchParam['no_of_adult']}} Adult, {{$flightSearchParam['no_of_child']}} child, {{$flightSearchParam['no_of_infant']}} Infant </span>
        </div>
    </div>
    <!-- END: PAGE TITLE -->

    <!-- START: BOOKING TAB -->
    <div class="row booking-tab">
        <div class="container clear-padding">
            <ul class="nav nav-tabs">
                <li class="col-md-offset-4 col-md-4 col-sm-offset-4 col-sm-4 col-xs-offset-4 col-xs-4"><a data-toggle="tab" href="#billing-info" class="text-center"><i class="fa fa-check-square"></i> <span>Billing Info</span></a></li>
            </ul>
        </div>
    </div>
    <div class="row booking-detail">
        <div class="container clear-padding">
            <div class="tab-content">
                <div id="billing-info"> {{--I removed class="tab-pane fade" from this div so that the content will not be hidden--}}
                    <div class="col-md-8 col-sm-8">
                        <div class="passenger-detail">
                            <h3>Total Payment to be made &#x20a6;{{number_format($selectedItinerary['customerTotal']/ 100, 2)}}</h3>
                            <div class="passenger-detail-body">
                                @if(!is_null($banks))
                                <div class="saved-card">
                                    <form method="post" action="{{url('/bank-payment')}}">
                                        @csrf
                                        @foreach($banks as $serial => $bank)
                                            <label data-toggle="collapse" data-target="#saved-card-1"><input type="radio" required name="bank_details_id" value="{{$bank->id}}"> <span>{{\App\Bank::find($bank->bank_id)->name}} , {{$bank->account_name}}, {{$bank->account_number}}</span></label>
                                            <div class="clearfix"></div>
                                            @endforeach
                                            <div>
                                              <button type="submit">CONFIRM BOOKING <i class="fa fa-chevron-right"></i></button>
                                            </div>
                                    </form>
                                </div>
                                    <div class="payment-seperator clearfix"></div>
                                @endif
                                    <div class="add-new-card">
                                    <h4>Add New Card</h4>
                                    <form >
                                        <div class="col-md-6 ol-sm-6">
                                            <label>Card Type</label>
                                            <select name="carttype" class="form-control">
                                                <option>Credit Card</option>
                                                <option>Debit Card</option>
                                                <option>Gift Card</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 ol-sm-6">
                                            <label>Card Number</label>
                                            <input type="text" name="cardnumber" required class="form-control">
                                        </div>
                                        <div class="col-md-6 ol-sm-6">
                                            <label>Card Expiry</label>
                                            <select name="cardexpiry" class="form-control">
                                                <option>Select</option>
                                                <option>Dec 2015</option>
                                                <option>Jan 2016</option>
                                                <option>Feb 2016</option>
                                                <option>Mar 2016</option>
                                                <option>Apr 2016</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 ol-sm-6">
                                            <label>CVV Number</label>
                                            <input type="password" name="cvvnumber" class="form-control">
                                        </div>
                                        <div class="col-md-12">
                                            <label><input type="checkbox" name="alert"> Save this card for future</label>
                                        </div>
                                        <div>
                                            <button type="submit">CONFIRM BOOKING <i class="fa fa-chevron-right"></i></button>
                                        </div>
                                    </form>
                                </div>
                                <div class="payment-seperator clearfix"></div>
                                <div class="paypal-pay">
                                    <h4>Pay Using Paypal</h4>
                                    <div class="col-md-2 col-sm-2 col-xs-4">
                                        <i class="fa fa-paypal"></i>
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-8">
                                        <a href="#">CONFIRM BOOKING</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-4 col-sm-4 booking-sidebar">
                        <div class="sidebar-item">
                            <h4><i class="fa fa-bookmark"></i>Fare Details</h4>
                            <div class="sidebar-body">
                                @if($selectedItinerary['priceChange'] != 0)
                                    <div class="alert alert-info">
                                        <strong><i class="fa fa-info"></i></strong> The Itinerary price changed by &#x20a6;{{number_format($selectedItinerary['priceChange'], 2)}}.
                                    </div>
                                @endif

                                <table class="table">
                                    @foreach($selectedItinerary['itineraryPassengerInfo'] as $serial => $passenger)
                                        @php $passenger = (array)$passenger; @endphp
                                        <tr>
                                            <td>{{$passenger['passengerType']}} {{$passenger['quantity']}}</td>
                                            <td>&#x20a6;{{number_format(($passenger['price']/100),2)}}</td>
                                        </tr>
                                    @endforeach

                                    @if(auth()->user())
                                        @role('agent')
                                        <tr>
                                            <td>Service Fee</td>
                                            <td>&#x20a6;{{number_format($selectedItinerary['adminToCustomerMarkup'] / 100, 2)}}</td>
                                        </tr>
                                        @endrole
                                        @role('customer')
                                        <tr>
                                            <td>Service Fee</td>
                                            <td>&#x20a6;{{number_format($selectedItinerary['adminToCustomerMarkup']/ 100, 2)}}</td>
                                        </tr>
                                        @endrole
                                    @else
                                        <tr>
                                            <td>Service Fee</td>
                                            <td>&#x20a6;{{number_format($selectedItinerary['adminToCustomerMarkup']/ 100, 2)}}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td>Vat</td>
                                        <td>&#x20a6;{{number_format($selectedItinerary['vat']/100, 2)}}</td>
                                    </tr>
                                    <tr>
                                        <td>Discount</td>
                                        <td>&#x20a6;{{number_format($selectedItinerary['airlineMarkdown']/100, 2)}}</td>
                                    </tr>
                                    @if(auth()->user())
                                        @role('agent')
                                        <tr>
                                            <td>Service Fee</td>
                                            <td>&#x20a6;{{number_format($selectedItinerary['agentTotal'] / 100, 2)}}</td>
                                        </tr>
                                        @endrole
                                        @role('customer')
                                        <tr>
                                            <td>You Pay</td>
                                            <td class="total">&#x20a6;{{number_format($selectedItinerary['customerTotal']/ 100, 2)}}</td>
                                        </tr>
                                        @endrole
                                        @role('admin')
                                        <tr>
                                            <td>You Pay</td>
                                            <td class="total">&#x20a6;{{number_format($selectedItinerary['adminTotal']/ 100, 2)}}</td>
                                        </tr>
                                        @endrole
                                    @else
                                        <tr>
                                            <td>You Pay</td>
                                            <td class="total">&#x20a6;{{number_format($selectedItinerary['customerTotal']/ 100, 2)}}</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                        <br/>
                        <div class="sidebar-item">
                            <h4><i class="fa fa-phone"></i>Need Help?</h4>
                            <div class="sidebar-body text-center">
                                <p>Need Help? Call us or drop a message. Our agents will be in touch shortly.</p>
                                <h2>+91 1234567890</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('css')

@endsection