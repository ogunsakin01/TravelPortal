@extends('layouts.app')

@section('page-title') Flight Result  @endsection

@section('content')
    <!-- START: PAGE TITLE -->
    {{--<div class="row page-title">--}}
        {{--<div class="container clear-padding text-center flight-title">--}}
            {{--<h3>Your Selection</h3>--}}
            {{--<h4><i class="fa fa-plane"></i>NEW DELHI<i class="fa fa-long-arrow-right"></i>NEW YORK</h4>--}}
            {{--<span><i class="fa fa-calendar"></i> 05 Aug <i class="fa fa-male"></i>Traveller(s) - 2 Adult</span>--}}
        {{--</div>--}}
    {{--</div>--}}
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
                            <h3>Total Payment to be made $499</h3>
                            <div class="passenger-detail-body">
                                <div class="saved-card">
                                    <form >
                                        <label data-toggle="collapse" data-target="#saved-card-1"><input type="radio" name="card"> <span>Bank of America 1234 XXXX XXXX 1290</span></label>
                                        <div id="saved-card-1" class="collapse">
                                            <div class="col-md-4 col-sm-4">
                                                <label>CVV</label>
                                                <input type="password" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <label data-toggle="collapse" data-target="#saved-card-2"><input type="radio" name="card"> <span>State Bank of India 1234 XXXX XXXX 1290</span></label>
                                        <div id="saved-card-2" class="collapse">
                                            <div class="col-md-4 col-sm-4">
                                                <label>CVV</label>
                                                <input type="password" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div>
                                            <button type="submit">CONFIRM BOOKING <i class="fa fa-chevron-right"></i></button>
                                        </div>
                                    </form>
                                </div>
                                <div class="payment-seperator clearfix"></div>
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
                    <div class="col-md-4 col-sm-4 booking-sidebar">
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