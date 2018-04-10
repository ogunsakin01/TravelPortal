<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function flightSearchResult()
    {
        return view('pages.flight.search_result');
    }

    public function flightItineraryBooking()
    {
        return view('pages.flight.itinerary_booking');
    }

    public function flightPaymentOption()
    {
        return view('pages.flight.payment_option');
    }

    public function flightPaymentConfirmation()
    {
        return view('pages.flight.payment_confirmation');
    }
}
