<?php

namespace App\Http\Controllers;

use App\Services\AmadeusConfig;
use App\Services\AmadeusHelper;
use App\Markup;
use App\Markdown;
use App\Vat;

class ViewController extends Controller
{

    private $AmadeusHelper;

    private $AmadeusConfig;

    public function __construct(){
        $this->AmadeusHelper = new AmadeusHelper();
        $this->AmadeusConfig = new AmadeusConfig();
    }

    public function availableItineraries(){

        $availableItineraries = session()->get('availableItineraries');
        $availableAirlines    = $this->AmadeusHelper->lowFarePlusResponseAvailableAirline($availableItineraries);
        $availableCabins      = $this->AmadeusHelper->lowFarePlusResponseAvailableCabin($availableItineraries);
        $availableStops       = $this->AmadeusHelper->lowFarePlusResponseAvailableStops($availableItineraries);
        $availablePrices      = json_encode($this->AmadeusHelper->lowFarePlusResponseAvailablePrice($availableItineraries));
        $minimumPrice         = round($availableItineraries[0]['displayTotal'] /100);
        $lastItinerary        = count($availableItineraries) - 1;
        $maximumPrice         = round($availableItineraries[$lastItinerary]['displayTotal'] / 100);

        return view('pages.flight.search_result',compact('availableItineraries','availableCabins','availableAirlines','minimumPrice','maximumPrice','availableStops','availablePrices'));
    }

    public function itineraryBooking(){

        $itineraryPricingInfo = session()->get('itineraryPricingInfo');
        $selectedItinerary = session()->get('selectedItinerary');
        $flightSearchParam = session()->get('flightSearchParam');

//        dd($selectedItinerary);
        return view('pages.flight.itinerary_booking',compact('itineraryPricingInfo','selectedItinerary','flightSearchParam'));

    }

}
