<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotelBooking extends Model
{
    protected $fillable = [
        'user_id',
        'reference',
        'pnr',
        'hotel_name',
        'hotel_code',
        'hotel_city_code',
        'hotel_chain_name',
        'room_booking_code',
        'rate_plan_code',
        'guarantee',
        'adult_guest',
        'child_guest',
        'check_in_date',
        'check_out_date',
        'base_amount',
        'vat',
        'markup',
        'markdown',
        'voucher_id',
        'voucher_amount',
        'total_amount',
        'expiry_date',
        'payment_status',
        'cancellation_status'
    ];



}
