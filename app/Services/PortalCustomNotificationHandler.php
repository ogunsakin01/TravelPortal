<?php
/**
 * Created by PhpStorm.
 * User: UniQue
 * Date: 4/5/2018
 * Time: 4:45 PM
 */


namespace App\Services;

use App\Mail\SuccessfulRegistration;
use Exception;
use Illuminate\Support\Facades\Mail;
use nilsenj\Toastr\Facades\Toastr;

class PortalCustomNotificationHandler
{

    public static function password($password){

    }

    public static function registrationSuccessful($user){
//        try{
           Mail::to($user['email'])->send(new SuccessfulRegistration($user));
//        }catch(Exception $e){
//           Toastr::info('We could not send you a welcome email.');
//        }
//        return 0;
    }


}