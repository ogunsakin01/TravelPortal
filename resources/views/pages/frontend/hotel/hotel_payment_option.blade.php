@extends('layouts.app')

@section('page-title') Hotel Payment Option  @endsection

@section('content')

    @php
        $AmadeusConfig = new \App\Services\AmadeusConfig();
        $AmadeusHelper = new \App\Services\AmadeusHelper();
        $InterswitchConfig = new \App\Services\InterswitchConfig();
    @endphp


    <!-- START: PAGE TITLE -->
    <div class="row page-title">
        <div class="container clear-padding text-center flight-title">
            <h3>{{strtoupper($hotelInformation['hotelName'])}}</h3>
            <h5>
                @for($i = 0; $i < $hotelInformation['hotelStarRating']; $i++)
                    <i class="fa fa-star"></i>
                @endfor
                @for($i = 0; $i < (5-$hotelInformation['hotelStarRating']); $i++)
                    <i class="fa fa-star-o"></i>
                @endfor
            </h5>
            <p><i class="fa fa-map-marker"></i> {{$hotelInformation['hotelAddress']}}</p>
        </div>
    </div>
    <!-- END: PAGE TITLE -->

    <!-- START: BOOKING TAB -->
    <div class="row booking-tab">
        <div class="container clear-padding">
            <ul class="nav nav-tabs">
                <li class="col-md-offset-4 col-md-4 col-sm-offset-4 col-sm-4 col-xs-offset-4 col-xs-4"><a data-toggle="tab" href="#billing-info" class="text-center"><i class="fa fa-check-square"></i> <span>Payment Options</span></a></li>
            </ul>
        </div>
    </div>
    <div class="row booking-detail">
        <div class="container clear-padding">
            <div class="tab-content">
                <div id="billing-info">
                        <div class="col-md-8 col-sm-8">
                            <div class="passenger-detail">
                                <h3>Total Payment to be made &#x20a6;{{number_format($selectedRoom['totalAmount']/ 100, 2)}}</h3>
                                <div class="passenger-detail-body">
                                    @if(!is_null($banks))
                                        <div class="saved-card">
                                            <form method="post" action="{{url('/hotel-bank-payment')}}">
                                                @csrf
                                                <input type="hidden" name="booking_reference" value="{{$selectedRoom['bookingReference']}}"/>
                                            @foreach($banks as $serial => $bank)
                                                    <label data-toggle="collapse" data-target="#saved-card-1">
                                                        <input type="radio" required name="bank_details_id" value="{{$bank->id}}">
                                                        <span>{{\App\Bank::find($bank->bank_id)->name}} , {{$bank->account_name}}, {{$bank->account_number}}</span>
                                                    </label>
                                                    <div class="clearfix"></div>
                                                @endforeach
                                                <div>
                                                    <button type="submit">CONFIRM BOOKING <i class="fa fa-chevron-right"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="payment-seperator clearfix"></div>
                                    @endif
                                    <div class="paypal-pay">
                                        <h4>Pay Using Interswitch</h4>
                                        <div class="col-md-8 col-sm-8">
                                            <img src="{{asset('frontend/assets/images/portal_images/interswitch.png')}}" class="img-responsive"/>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <input  type="hidden"  class="booking_reference" value="{{$selectedRoom['bookingReference']}}"/>
                                            <form method="post" action="{{$InterswitchConfig->requestActionUrl}}">

                                                <input  type="hidden"  class="reference"      name="txn_ref" value=""/>
                                                <input  type="hidden"  class="amount"         name="amount" value="{{$selectedRoom['totalAmount']}}"/>
                                                <input  type="hidden"  name="currency"        value="566"/>
                                                <input  type="hidden"  class="item_id"        name="pay_item_id" value="{{$InterswitchConfig->item_id}}"/>
                                                <input  type="hidden"  class="redirect_url"   name="site_redirect_url" value=""/>
                                                <input  type="hidden"  class="product_id"     name="product_id" value="{{$InterswitchConfig->product_id}}"/>
                                                <input  type="hidden"  class="cust_id"        name="cust_id" value="{{auth()->user()->id}}"/>
                                                <input  type="hidden"  name="cust_name"       value="{{\App\Profile::getUserInfo(auth()->user()->id)->first_name}}"/>
                                                <input  type="hidden"  class="hash"           name="hash" value=""/>

                                                <button type="button"  class="btn btn_travel_portal confirm_interswitch_booking">CONFIRM BOOKING </button>
                                                <button type="submit"  class="btn btn_travel_portal interswitch_pay_now hidden">PAY NOW</button>

                                            </form>
                                        </div>
                                    </div>
                                    <div class="payment-seperator clearfix"></div>
                                    <div class="paypal-pay">
                                        <h4>Pay Using PayStack</h4>
                                        <div class="col-md-8 col-sm-8">
                                            <img src="{{asset('frontend/assets/images/portal_images/paystack.png')}}" class="img-responsive"/>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <form method="post" action="{{url('/generate-paystack-payment')}}">
                                                @csrf
                                                <input type="hidden" name="amount" value="{{$selectedRoom['totalAmount']}}"/>
                                                <input type="hidden" name="booking_reference" value="{{$selectedRoom['bookingReference']}}"/>
                                                <input type="hidden" name="email" value="{{auth()->user()->email}}"/>
                                                <button type="submit">Pay Now </button>
                                            </form>
                                        </div>
                                    </div>
                                        @role('agent')
                                        <div class="payment-seperator clearfix"></div>
                                        <div class="paypal-pay">
                                            @php
                                                $walletBalance = \App\Wallet::where('user_id',auth()->id())->first()->balance;
                                            @endphp
                                            <h4>Pay Using Wallet Balance</h4>
                                            <div class="col-md-4 col-sm-4">
                                                <img src="{{asset('frontend/assets/images/portal_images/wallet.png')}}" class="img-responsive"/>
                                            </div>
                                            <div class="col-md-8 col-sm-8">
                                                @if($walletBalance > $selectedRoom['totalAmount'])
                                                    <form method="post" action="{{url('hotel-wallet-payment')}}">
                                                        <b> Wallet Balance = &#x20A6; {{number_format(($walletBalance/100),2)}} </b>
                                                        @csrf
                                                        <p>
                                                            You have enough credit in your wallet, you can now make payment for this booking with your wallet credit.
                                                            <input type="hidden" class="booking_reference" name="booking_reference" value="{{$selectedRoom['bookingReference']}}"/>
                                                            <input type="hidden" class="amount" name="amount" value="{{$selectedRoom['totalAmount']}}"/>
                                                            <button type="submit" class="btn btn_travel_portal wallet_pay_now">CONFIRM BOOKING
                                                            </button>
                                                        </p>
                                                    </form>
                                                @else
                                                    <p>You do not have enough money in your wallet to make payment for this booking. Please top up your wallet and try again later.</p>
                                                @endif
                                            </div>
                                        </div>
                                        @endrole
                                        @role('admin')
                                        <div class="payment-seperator clearfix"></div>
                                        <div class="paypal-pay">
                                            @php
                                                $walletBalance = \App\Wallet::where('user_id',auth()->id())->first()->balance;
                                            @endphp
                                            <h4>Pay Using Wallet Balance</h4>
                                            <div class="col-md-4 col-sm-4">
                                                <img src="{{asset('frontend/assets/images/portal_images/wallet.png')}}" class="img-responsive"/>
                                            </div>
                                            <div class="col-md-8 col-sm-8">
                                                @if($walletBalance > $selectedRoom['totalAmount'])
                                                    <form method="post" action="{{url('hotel-wallet-payment')}}">
                                                        <b> Wallet Balance = &#x20A6; {{number_format(($walletBalance/100),2)}} </b>
                                                        @csrf
                                                        <p>
                                                            You have enough credit in your wallet, you can now make payment for this booking with your wallet credit.
                                                            <input type="hidden" class="booking_reference" name="booking_reference" value="{{$selectedRoom['bookingReference']}}"/>
                                                            <input type="hidden" class="amount" name="amount" value="{{$selectedRoom['totalAmount']}}"/>
                                                            <button type="submit" class="btn btn_travel_portal wallet_pay_now">CONFIRM BOOKING
                                                            </button>
                                                        </p>
                                                    </form>
                                                @else
                                                    <p>You do not have enough money in your wallet to make payment for this booking. Please top up your wallet and try again later.</p>
                                                @endif
                                            </div>
                                        </div>
                                        @endrole
                                </div>
                            </div>
                        </div>
                    <div class="col-md-4 col-sm-4 booking-sidebar">
                        <div class="sidebar-item">
                            <h4><i class="fa fa-phone"></i>Need Help?</h4>
                            <div class="sidebar-body text-center">
                                <p>Need Help? Call us or drop a message. Our agents will be in touch shortly.</p>
                                <h3><a href="tel:{{\App\Services\PortalConfig::$adminBookingsNumber}}">{{\App\Services\PortalConfig::$adminBookingsNumber}}</a></h3>
                                <h3><a href="mailto:{{\App\Services\PortalConfig::$adminBookingsEmail}}">{{\App\Services\PortalConfig::$adminBookingsEmail}}</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
    <script src="{{asset('frontend/assets/js/pages/hotel/payment_option.js')}}"></script>
@endsection

@section('css')

@endsection