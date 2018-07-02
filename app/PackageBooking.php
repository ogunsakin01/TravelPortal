<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageBooking extends Model
{
    public static function store($data){
        $new_booking = new static();
        $new_booking->reference      = $data['reference'];
        $new_booking->user_id        = $data['user_id'];
        $new_booking->package_id     = $data['package_id'];
        $new_booking->adults         = $data['adults'];
        $new_booking->children       = $data['children'];
        $new_booking->infants        = $data['infants'];
        $new_booking->total_amount   = $data['total_amount'];
        $new_booking->payment_status = 0;
        $new_booking->save();
    }

    public static function updatePaymentStatus($data){
        $booking = static::where('reference', $data['reference'])->first();
        $booking->payment_status = $data['status'];
        $booking->update();
    }

    public static function getBookingByReference($reference){
        $a = static::where('reference', $reference)->first();
        return $a;
    }

    public static function getUserBookingsById($user_id){
        return static::where('user_id', $user_id)
            ->orderBy('id','desc')
            ->get();
    }

    public function deal(){
        return static::hasOne(TravelPackage::class,'id','package_id');
    }
}
