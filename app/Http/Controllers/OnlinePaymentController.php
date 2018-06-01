<?php

namespace App\Http\Controllers;

use App\FlightBooking;
use App\HotelBooking;
use App\OnlinePayment;
use App\Profile;
use App\User;
use App\Wallet;
use App\WalletLog;
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
        if(!isset($r->booking_reference) || empty($r->booking_reference) || is_null($r->booking_reference)){
            $txnRef = $r->booking_reference;
        }

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

    public function generateInterswitchWalletPayment(Request $r){
        $redirectUrl = url('/backend/interswitch-payment-verification');
        $txnRef      = strtoupper(str_random(9));
        $bookingReference = "WTP-".strtoupper(str_random(8));
        $paymentAmount = $r->amount * 100;

        $hash = $this->InterswitchConfig->transactionHash($txnRef,$paymentAmount,$redirectUrl);
        $saveData = [
            'reference'            => $txnRef,
            'user_id'              => auth()->user()->id,
            'booking_reference'    => $bookingReference,
            'amount'               => $paymentAmount,
            'gateway_id'           => 1,
            'response_code'        => 0,
            'response_description' => 'Pending',
            'payment_status'       => 0,
            'response_full'        => ''
        ];

        OnlinePayment::create($saveData);

        return [
            'reference'      => $txnRef,
            'redirect_url'   => $redirectUrl,
            'hash'           => $hash,
            'amount'         => $paymentAmount
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

              if(substr($paymentData->booking_reference,0,3) == "AIR"){

                  $booking     = FlightBooking::where('reference',$paymentData->booking_reference)->first();
                  $booking->payment_status = 1;
                  $booking->update();

                  $profile     = Profile::getUserInfo($booking->user_id);

                  PortalCustomNotificationHandler::paymentSuccessful($response);
                  PortalCustomNotificationHandler::flightReservationComplete($response,$booking,$profile);

              }elseif(substr($paymentData->booking_reference,0,3) == "HOT"){

                  $booking     = HotelBooking::where('reference',$paymentData->booking_reference)->first();
                  $booking->payment_status = 1;
                  $booking->update();

                  $profile     = Profile::getUserInfo($booking->user_id);

                  PortalCustomNotificationHandler::paymentSuccessful($response);

              }


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
          if(substr($paymentData->booking_reference,0,3) == "AIR"){
              return redirect('/flight-booking-confirmation');
          }
          elseif(substr($paymentData->booking_reference,0,3) == "HOT"){
              return redirect('/hotel-booking-confirmation');
          }


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

            if(substr($paymentData->booking_reference,0,3) == "AIR"){

                $booking     = FlightBooking::where('reference',$paymentData->booking_reference)->first();
                $booking->payment_status = 1;
                $booking->update();

                $profile     = Profile::getUserInfo($booking->user_id);

                PortalCustomNotificationHandler::paymentSuccessful($response);
                PortalCustomNotificationHandler::flightReservationComplete($response,$booking,$profile);

            }
            elseif(substr($paymentData->booking_reference,0,3) == "HOT"){

                $booking     = HotelBooking::where('reference',$paymentData->booking_reference)->first();
                $booking->payment_status = 1;
                $booking->update();

                $profile     = Profile::getUserInfo($booking->user_id);

                PortalCustomNotificationHandler::paymentSuccessful($response);

            }



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
        if(substr($paymentData->booking_reference,0,3) == "AIR"){
            return redirect('/flight-booking-confirmation');
        }
        elseif(substr($paymentData->booking_reference,0,3) == "HOT"){
            return redirect('/hotel-booking-confirmation');
        }


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

            if(substr($paymentData->booking_reference,0,3) == "AIR"){

                $booking     = FlightBooking::where('reference',$paymentData->booking_reference)->first();
                $booking->payment_status = 1;
                $booking->update();

                $profile     = Profile::getUserInfo($booking->user_id);

                PortalCustomNotificationHandler::paymentSuccessful($response);
                PortalCustomNotificationHandler::flightReservationComplete($response,$booking,$profile);

            }
            elseif(substr($paymentData->booking_reference,0,3) == "HOT"){

                $booking     = HotelBooking::where('reference',$paymentData->booking_reference)->first();
                $booking->payment_status = 1;
                $booking->update();

                $profile     = Profile::getUserInfo($booking->user_id);

                PortalCustomNotificationHandler::paymentSuccessful($response);

            }
            elseif(substr($paymentData->booking_reference,0,3) == "WTP"){

                $wallet = Wallet::where('user_id',auth()->id())->first();
                $user = User::authenticatedUserInfo();
                $walletBalance = $wallet->balance;
                $newWalletBalance = $walletBalance;
                $newWalletBalance = $walletBalance + $r->amount;
                $addLog = WalletLog::create([
                    'user_id' => auth()->id(),
                    'amount'  => $r->amount,
                    'status'  => 1,
                    'type_id' => 3,
                ]);
                PortalCustomNotificationHandler::walletCredit($user,$addLog);
                $wallet->balance = $newWalletBalance;
                $wallet->update();
                Toastr::success("Wallet has been topped up successfully");
                PortalCustomNotificationHandler::paymentSuccessful($response);

            }


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

            if(substr($paymentData->booking_reference,0,3) == "AIR"){

                $booking = FlightBooking::where('reference',$paymentData->booking_reference)->first();
                $booking->payment_status = 1;
                $booking->update();

                $profile = Profile::getUserInfo($booking->user_id);

                PortalCustomNotificationHandler::paymentSuccessful($response);
                PortalCustomNotificationHandler::flightReservationComplete($response,$booking,$profile);

            }elseif(substr($paymentData->booking_reference,0,3) == "HOT"){

                $booking = HotelBooking::where('reference',$paymentData->booking_reference)->first();
                $booking->payment_status = 1;
                $booking->update();

                $profile = Profile::getUserInfo($booking->user_id);

                PortalCustomNotificationHandler::paymentSuccessful($response);

            }

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

            if(substr($paymentData->booking_reference,0,3) == "AIR"){

                $booking     = FlightBooking::where('reference',$paymentData->booking_reference)->first();
                $booking->payment_status = 1;
                $booking->update();

                $profile     = Profile::getUserInfo($booking->user_id);

                PortalCustomNotificationHandler::paymentSuccessful($response);
                PortalCustomNotificationHandler::flightReservationComplete($response,$booking,$profile);

            }
            elseif(substr($paymentData->booking_reference,0,3) == "HOT"){

                $booking     = HotelBooking::where('reference',$paymentData->booking_reference)->first();
                $booking->payment_status = 1;
                $booking->update();

                $profile     = Profile::getUserInfo($booking->user_id);

                PortalCustomNotificationHandler::paymentSuccessful($response);

            }
            elseif(substr($paymentData->booking_reference,0,3) == "WTP"){

                $wallet = Wallet::where('user_id',auth()->id())->first();
                $user = User::authenticatedUserInfo();
                $walletBalance = $wallet->balance;
                $newWalletBalance = $walletBalance;
                $newWalletBalance = $walletBalance + $payment->amount;
                $addLog = WalletLog::create([
                    'user_id' => auth()->id(),
                    'amount'  => $payment->amount,
                    'status'  => 1,
                    'type_id' => 3,
                ]);
                PortalCustomNotificationHandler::walletCredit($user,$addLog);
                $wallet->balance = $newWalletBalance;
                $wallet->update();
                PortalCustomNotificationHandler::paymentSuccessful($response);

            }

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
