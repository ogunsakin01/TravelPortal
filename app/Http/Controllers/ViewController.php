<?php

namespace App\Http\Controllers;

use App\Services\AmadeusHelper;

class ViewController extends Controller
{

    private $AmadeusHelper;

    public function __construct(){
        $this->AmadeusHelper = new AmadeusHelper();
    }

    public function availableItineraries(){

        $availableItinerariesXML = session()->get('availableItinerariesXML');
        $availableItineraries = $this->AmadeusHelper->lowFarePlusResponseSortFromXML($availableItinerariesXML);

        dd($availableItineraries);

        $availableAirlines    = $this->AmadeusHelper->lowFarePlusResponseAvailableAirline($availableItineraries);
        $availableCabins      = $this->AmadeusHelper->lowFarePlusResponseAvailableCabin($availableItineraries);
        $availableStops       = $this->AmadeusHelper->lowFarePlusResponseAvailableStops($availableItineraries);
        $availablePrices      = json_encode($this->AmadeusHelper->lowFarePlusResponseAvailablePrice($availableItineraries));
        $minimumPrice         = round($availableItineraries[0]['displayTotal'] /100);
        $lastItinerary        = count($availableItineraries) - 1;
        $maximumPrice         = round($availableItineraries[$lastItinerary]['displayTotal'] / 100);

        return view('pages.flight.search_result',compact('availableItineraries','availableCabins','availableAirlines','minimumPrice','maximumPrice','availableStops','availablePrices'));
    }

}
