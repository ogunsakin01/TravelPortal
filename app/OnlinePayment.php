<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnlinePayment extends Model
{

    protected $fillable = [
        'reference'           ,
        'user_id'             ,
        'booking_reference'   ,
        'amount'              ,
        'gateway_id'          ,
        'response_code'       ,
        'response_description',
        'payment_status'      ,
        'response_full'
    ];

    public static function updatePayment($data){

    }
}
