@extends('layouts.backend')

@section('page-title') Payment Confirmation @endsection


@section('content')

    <div class="row" align="center">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="card text-center">
                <div class="card-content">
                    <div class="card-body">
                        @if($paymentInfo['status'] == 1)
                        <h4 class="card-title success"><i class="la la-check-circle-o la-3x "></i><br/>{{$paymentInfo['message']}}</h4>
                            <p class="card-text">Your payment is successful, please refer bookings page to see the status of the booking. Emails containing your payment and reservation will be sent to you.</p>
                        @elseif($paymentInfo['status'] == 0)
                            <h4 class="card-title warning"><i class="la la-warning la-3x"></i><br/>{{$paymentInfo['message']}}</h4>
                            <p class="card-text">Your payment could not be verified, please check your email for more information.</p>
                        @endif
                        <a href="{{url('/dashboard')}}" class="btn btn-outline-dark">Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection