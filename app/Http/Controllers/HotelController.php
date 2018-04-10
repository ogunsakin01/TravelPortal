<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function HotelSearchResult()
    {
        return view('pages.hotel.search_result');
    }

    public function hotelBooking()
    {
        return view('pages.hotel.hotel_booking');
    }

    public function hotelPaymentOption()
    {
        return view('pages.flight.hotel_payment_option');
    }

    public function hotelPaymentConfirmation()
    {
        return view('pages.hotel.hotel_payment_confirmation');
    }

    public function hotelDetails()
    {
        return view('pages.hotel.hotel_details');
    }

    public function roomDetails()
    {
        return view('pages.hotel.hotel_room_details');
    }
}
