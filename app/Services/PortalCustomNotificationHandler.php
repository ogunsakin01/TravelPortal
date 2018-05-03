<?php
/**
 * Created by PhpStorm.
 * User: UniQue
 * Date: 4/5/2018
 * Time: 4:45 PM
 */


namespace App\Services;

use App\FlightBooking;
use App\Mail\BankPaymentOptionNotification;
use App\Mail\FlightReservationComplete;
use App\Mail\PaymentFailed;
use App\Mail\PaymentNotification;
use App\Mail\PaymentSuccessful;
use App\Mail\ReservationCancelled;
use App\Mail\SuccessfulRegistration;
use App\Mail\TicketIssued;
use App\Mail\TicketVoid;
use Exception;
use Illuminate\Support\Facades\Mail;
use nilsenj\Toastr\Facades\Toastr;

class PortalCustomNotificationHandler
{

    public static function registrationSuccessful($user){
        try{
           Mail::to($user['email'])->send(new SuccessfulRegistration($user));
        }catch(Exception $e){
           Toastr::info('We could not send you a welcome email.');
        }
        return 0;
    }

    public static function interswitchPrepayment(array $data){
        try{
            Mail::to(auth()->user())->send(new PaymentNotification($data));
        }catch(Exception $e){
            Toastr::info('Sorry, unable to send you a payment notification email.');
        }
        return 0;
    }

    public static function payByBank($booking){
        try{
            Mail::to(auth()->user())->send(new BankPaymentOptionNotification($booking));
        }catch(Exception $e){
            Toastr::info("Sorry, unable to send you an email confirming your bank payment choice.");
        }

        return 0;
    }

    public static function paymentSuccessful($response){
        try{
            Mail::to(auth()->user())->send(new PaymentSuccessful($response));
        }catch(Exception $e){
            Toastr::info("Sorry, unable to send you an email confirming your payment.");
        }

        return 0;
    }

    public static function paymentFailed($response){
        try{
            Mail::to(auth()->user())->send(new PaymentFailed($response));
        }catch(Exception $e){
            Toastr::info("Sorry, unable to send you a payment failed notification.");
        }

       return 0;
    }

    public static function flightReservationComplete($response,$booking,$profile){
        try{
            Mail::to(auth()->user())->send(new FlightReservationComplete($response,$booking,$profile));
        }catch(Exception $e){
            Toastr::info("Sorry, unable to send flight reservation email.");
        }
        return 0;
    }

    public static function reservationCancelled($user,$pnr){
        $booking = FlightBooking::where('pnr',$pnr)->first();
        try{
            Mail::to($user)->send(new ReservationCancelled($user,$booking));
        }catch(Exception $e){
            Toastr::error('Unable to send cancel reservation email');
        }
        return 0;
    }

    public static function ticketIssued($user,$pnr){
        $booking = FlightBooking::where('pnr',$pnr)->first();
        try{
            Mail::to($user)->send(new TicketIssued($user,$booking));
        }catch(Exception $e){
            Toastr::error('Unable to send issue ticket email');
        }
        return 0;
    }

    public static function voidTicket($user,$ticketNumber){
        try{
            Mail::to($user)->send(new TicketVoid($user,$ticketNumber));
        }catch(Exception $e){
            Toastr::error('Unable to send void ticket email');
        }
    }


}