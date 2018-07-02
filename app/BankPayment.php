<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankPayment extends Model
{

    protected $fillable = [
        'user_id',
        'booking_reference',
        'reference',
        'amount',
        'bank_detail_id',
        'slip_photo',
        'status'
    ];

    public static function store($booking,$bank_details_id){

        $store = static::updateOrCreate([
            'user_id'           => auth()->id(),
            'booking_reference' => $booking->reference
        ],[
            'reference'      => strtoupper(str_random(6)),
            'amount'         => $booking->total_amount,
            'bank_detail_id' => $bank_details_id,
            'slip_photo'     => '',
            'status'         => 2,
        ]);

        return $store;
    }

}
