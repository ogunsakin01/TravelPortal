<?php
/**
 * Created by PhpStorm.
 * User: UniQue
 * Date: 4/5/2018
 * Time: 4:45 PM
 */


namespace App\Services;

use App\Mail\BankPaymentOptionNotification;
use App\Mail\PaymentNotification;
use App\Mail\SuccessfulRegistration;
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
            Toastr::info('Sorry, unable to send you a payment notification email');
        }
        return 0;
    }

    public static function PayByBank($booking){

        Mail::to(auth()->user())->send(new BankPaymentOptionNotification($booking));

        return 0;
    }


}