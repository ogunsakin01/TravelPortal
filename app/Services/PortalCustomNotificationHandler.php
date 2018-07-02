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
use App\Mail\HotelReservationComplete;
use App\Mail\PasswordChange;
use App\Mail\PasswordReset;
use App\Mail\PaymentFailed;
use App\Mail\PaymentNotification;
use App\Mail\PaymentSuccessful;
use App\Mail\ReservationCancelled;
use App\Mail\SuccessfulRegistration;
use App\Mail\TicketIssued;
use App\Mail\TicketVoid;
use App\Mail\WalletCredit;
use App\Mail\WalletDebit;
use App\Mail\VisaApplicationRequest;
use App\Mail\PackageReservationComplete;
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

    public static function bookHotelRoom($user,$hotelInfo,$roomInfo,$bookingInfo){

        try{
            Mail::to($user)->send(new HotelReservationComplete($user,$hotelInfo,$roomInfo,$bookingInfo));
        }catch(Exception $e){
            Toastr::error('Unable to send hotel reservation email');
        }

    }

    public static function passwordReset(){
        try{
            Mail::to(auth()->user())->send(new PasswordReset());
        }catch(Exception $e){
            Toastr::error('Unable to send password reset email.');
        }
    }

    public static function walletCredit($user, $walletLog){
        try{
            Mail::to($user->email)->send(new WalletCredit($user,$walletLog));
        }catch(Exception $e){
            Toastr::error('Unable to send wallet credit alert email');
        }
    }

    public static function walletDebit($user, $walletLog){
        try{
            Mail::to($user->email)->send(new WalletDebit($user,$walletLog));
        }catch(Exception $e){
            TOastr::error('Unable to send wallet debit email');
        }
    }

    public static function visaApplicationRequest($details){
        try{
            Mail::to(PortalConfig::$adminVisaApplicationEmail)->send(new VisaApplicationRequest($details));
        }catch(Exception $e){
            Toastr::error('Unable to send visa application email','Email Error!!!');
        }
    }

    public static function packageReservationComplete($booking,$deal,$user){
        Mail::to(auth()->user())->send(new PackageReservationComplete($booking,$deal,$user));
    }

}