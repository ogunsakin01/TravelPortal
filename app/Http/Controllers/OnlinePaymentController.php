<?php

namespace App\Http\Controllers;

use App\OnlinePayment;
use App\Services\InterswitchConfig;
use App\Services\PaystackConfig;
use Illuminate\Http\Request;

class OnlinePaymentController extends Controller
{
    private $InterswitchConfig;

    private $PaystackConfig;

    public function __construct(){
        $this->InterswitchConfig = new InterswitchConfig();
        $this->PaystackConfig    = new PaystackConfig();
    }

    public function generateInterswitchPayment(Request $r){

        $redirectUrl = url('/interswitch-payment-verification');
        $txnRef      = strtoupper(str_random(9));

        $hash = $this->InterswitchConfig->transactionHash($txnRef,$r->amount,$redirectUrl);
        $saveData = [
            'reference'            => $txnRef,
            'user_id'              => auth()->user()->id,
            'booking_reference'    => $r->booking_reference,
            'amount'               => $r->amount,
            'gateway_id'           => 1,
            'response_code'        => 0,
            'response_description' => 'Pending',
            'payment_status'       => 0,
            'response_full'        => ''
        ];

        $create = OnlinePayment::create($saveData);

        return [
            'reference'      => $txnRef,
            'redirect_url'   => $redirectUrl,
            'hash'           => $hash
        ];

    }

    public function payStackPaymentVerification(Request $r){
        $redirectUrl = url('/paystack-payment-verification');
        $txnRef      = strtoupper(str_random(9));
        $saveData = [
            'reference'            => $txnRef,
            'user_id'              => auth()->user()->id,
            'booking_reference'    => $r->booking_reference,
            'amount'               => $r->amount,
            'gateway_id'           => 2,
            'response_code'        => 0,
            'response_description' => 'Pending',
            'payment_status'       => 0,
            'response_full'        => ''
        ];

        $create = OnlinePayment::create($saveData);

        $paystack = $this->PaystackConfig->initialize($r->email,$r->amount,$txnRef,$redirectUrl);
        dd($paystack);
    }

}
