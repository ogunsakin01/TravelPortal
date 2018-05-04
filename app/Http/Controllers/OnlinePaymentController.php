<?php

namespace App\Http\Controllers;

use App\FlightBooking;
use App\OnlinePayment;
use App\Profile;
use App\Services\InterswitchConfig;
use App\Services\PaystackConfig;
use App\Services\PortalCustomNotificationHandler;
use Illuminate\Http\Request;
use nilsenj\Toastr\Facades\Toastr;

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

    public function generatePayStackPayment(Request $r){
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

        return $paystack;
    }

    public function interswitchPaymentVerification(Request $r){

          $response = $this->InterswitchConfig->requery($r->txnref,$r->amount);

          if($response['responseCode'] == '00' || $response['responseCode'] == '11' || $response['responseCode'] == '10'){

              Toastr::success($response['responseDescription']);

              $paymentInfo  = [
                  'status'  => 1,
                  'message' => $response['responseDescription']
              ];

              $paymentData = OnlinePayment::where('reference',$response['reference'])->first();
              $paymentData->payment_status       = 1;
              $paymentData->response_code        = $response['responseCode'];
              $paymentData->response_description = $response['responseDescription'];
              $paymentData->response_full        = $response['responseFull'];
              $paymentData->update();

              $booking     = FlightBooking::where('reference',$paymentData->booking_reference)->first();
              $booking->payment_status = 1;
              $booking->update();

              $profile     = Profile::getUserInfo($booking->user_id);

              PortalCustomNotificationHandler::paymentSuccessful($response);
              PortalCustomNotificationHandler::flightReservationComplete($response,$booking,$profile);

          }
          else{

              Toastr::error($response['responseDescription']);
              $paymentInfo  = [
                  'status'  => 0,
                  'message' => $response['responseDescription']
              ];

              $paymentData = OnlinePayment::where('reference',$response['reference'])->first();
              $paymentData->payment_status       = 0;
              $paymentData->response_code        = $response['responseCode'];
              $paymentData->response_description = $response['responseDescription'];
              $paymentData->response_full        = $response['responseFull'];
              $paymentData->update();

              PortalCustomNotificationHandler::paymentFailed($response);

          }

        session()->put('paymentInfo',$paymentInfo);
        return redirect('/flight-booking-confirmation');

    }

    public function payStackPaymentVerification(){
          $response = $this->PaystackConfig->query($_GET['reference']);
        if($response['responseCode'] == '00' || $response['responseCode'] == '11' || $response['responseCode'] == '10'){

            Toastr::success($response['responseDescription']);

            $paymentInfo  = [
                'status'  => 1,
                'message' => $response['responseDescription']
            ];

            $paymentData = OnlinePayment::where('reference',$response['reference'])->first();
            $paymentData->payment_status       = 1;
            $paymentData->response_code        = $response['responseCode'];
            $paymentData->response_description = $response['responseDescription'];
            $paymentData->response_full        = $response['responseFull'];
            $paymentData->update();

            $booking     = FlightBooking::where('reference',$paymentData->booking_reference)->first();
            $booking->payment_status = 1;
            $booking->update();

            $profile     = Profile::getUserInfo($booking->user_id);

            PortalCustomNotificationHandler::paymentSuccessful($response);
            PortalCustomNotificationHandler::flightReservationComplete($response,$booking,$profile);

        }
        else{

            Toastr::error($response['responseDescription']);
            $paymentInfo  = [
                'status'  => 0,
                'message' => $response['responseDescription']
            ];

            $paymentData = OnlinePayment::where('reference',$response['reference'])->first();
            $paymentData->payment_status       = 0;
            $paymentData->response_code        = $response['responseCode'];
            $paymentData->response_description = $response['responseDescription'];
            $paymentData->response_full        = $response['responseFull'];
            $paymentData->update();

            PortalCustomNotificationHandler::paymentFailed($response);

        }

        session()->put('paymentInfo',$paymentInfo);
        return redirect('/flight-booking-confirmation');

    }

    public function generateInterswitchPaymentBackEnd(Request $r){
        $redirectUrl = url('/backend/interswitch-payment-verification');
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

    public function generatePayStackPaymentBackEnd(Request $r){
        $redirectUrl = url('/backend/paystack-payment-verification');
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

        return $paystack;
    }

    public function interswitchPaymentVerificationBackEnd(Request $r){

        $response = $this->InterswitchConfig->requery($r->txnref,$r->amount);

        if($response['responseCode'] == '00' || $response['responseCode'] == '11' || $response['responseCode'] == '10'){

            Toastr::success($response['responseDescription']);

            $paymentInfo  = [
                'status'  => 1,
                'message' => $response['responseDescription']
            ];

            $paymentData = OnlinePayment::where('reference',$response['reference'])->first();
            $paymentData->payment_status       = 1;
            $paymentData->response_code        = $response['responseCode'];
            $paymentData->response_description = $response['responseDescription'];
            $paymentData->response_full        = $response['responseFull'];
            $paymentData->update();

            $booking     = FlightBooking::where('reference',$paymentData->booking_reference)->first();
            $booking->payment_status = 1;
            $booking->update();

            $profile     = Profile::getUserInfo($booking->user_id);

            PortalCustomNotificationHandler::paymentSuccessful($response);
            PortalCustomNotificationHandler::flightReservationComplete($response,$booking,$profile);

        }
        else{

            Toastr::error($response['responseDescription']);
            $paymentInfo  = [
                'status'  => 0,
                'message' => $response['responseDescription']
            ];

            $paymentData = OnlinePayment::where('reference',$response['reference'])->first();
            $paymentData->payment_status       = 0;
            $paymentData->response_code        = $response['responseCode'];
            $paymentData->response_description = $response['responseDescription'];
            $paymentData->response_full        = $response['responseFull'];
            $paymentData->update();

            PortalCustomNotificationHandler::paymentFailed($response);

        }

        session()->put('paymentInfo',$paymentInfo);
        return redirect('/backend/payment-confirmation');

    }

    public function payStackPaymentVerificationBackEnd(){
        $response = $this->PaystackConfig->query($_GET['reference']);
        if($response['responseCode'] == '00' || $response['responseCode'] == '11' || $response['responseCode'] == '10'){

            Toastr::success($response['responseDescription']);

            $paymentInfo  = [
                'status'  => 1,
                'message' => $response['responseDescription']
            ];

            $paymentData = OnlinePayment::where('reference',$response['reference'])->first();
            $paymentData->payment_status       = 1;
            $paymentData->response_code        = $response['responseCode'];
            $paymentData->response_description = $response['responseDescription'];
            $paymentData->response_full        = $response['responseFull'];
            $paymentData->update();

            $booking     = FlightBooking::where('reference',$paymentData->booking_reference)->first();
            $booking->payment_status = 1;
            $booking->update();

            $profile     = Profile::getUserInfo($booking->user_id);

            PortalCustomNotificationHandler::paymentSuccessful($response);
            PortalCustomNotificationHandler::flightReservationComplete($response,$booking,$profile);

        }
        else{

            Toastr::error($response['responseDescription']);
            $paymentInfo  = [
                'status'  => 0,
                'message' => $response['responseDescription']
            ];

            $paymentData = OnlinePayment::where('reference',$response['reference'])->first();
            $paymentData->payment_status       = 0;
            $paymentData->response_code        = $response['responseCode'];
            $paymentData->response_description = $response['responseDescription'];
            $paymentData->response_full        = $response['responseFull'];
            $paymentData->update();

            PortalCustomNotificationHandler::paymentFailed($response);

        }

        session()->put('paymentInfo',$paymentInfo);
        return redirect('/backend/payment-confirmation');

    }

    public function requery($id){

        $payment = OnlinePayment::find($id);
        $response = $this->InterswitchConfig->requery($payment->reference,$payment->amount);

        if($response['responseCode'] == '00' || $response['responseCode'] == '11' || $response['responseCode'] == '10'){

            Toastr::success($response['responseDescription']);

            $paymentInfo  = [
                'status'  => 1,
                'message' => $response['responseDescription']
            ];

            $paymentData = OnlinePayment::where('reference',$response['reference'])->first();
            $paymentData->payment_status       = 1;
            $paymentData->response_code        = $response['responseCode'];
            $paymentData->response_description = $response['responseDescription'];
            $paymentData->response_full        = $response['responseFull'];
            $paymentData->update();

            $booking     = FlightBooking::where('reference',$paymentData->booking_reference)->first();
            $booking->payment_status = 1;
            $booking->update();

            $profile     = Profile::getUserInfo($booking->user_id);

            PortalCustomNotificationHandler::paymentSuccessful($response);
            PortalCustomNotificationHandler::flightReservationComplete($response,$booking,$profile);

        }
        else{

            Toastr::error($response['responseDescription']);
            $paymentInfo  = [
                'status'  => 0,
                'message' => $response['responseDescription']
            ];

            $paymentData = OnlinePayment::where('reference',$response['reference'])->first();
            $paymentData->payment_status       = 0;
            $paymentData->response_code        = $response['responseCode'];
            $paymentData->response_description = $response['responseDescription'];
            $paymentData->response_full        = $response['responseFull'];
            $paymentData->update();

            PortalCustomNotificationHandler::paymentFailed($response);

        }
        return $response;

    }

}
