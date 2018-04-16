<?php

namespace App\Http\Controllers;

use App\Services\AmadeusHelper;
use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;

class ViewController extends Controller
{

    private $AmadeusHelper;

    public function __construct(){
        $this->AmadeusHelper = new AmadeusHelper();
    }

    public function availableItineraries(){

        $availableItineraries = session()->get('availableItineraries');
        $availableAirlines    = $this->AmadeusHelper->LowFarePlusResponseAvailableAirline($availableItineraries);
        $availableCabins      = $this->AmadeusHelper->LowFarePlusResponseAvailableCabin($availableItineraries);
        $availableStops       = $this->AmadeusHelper->LowFarePlusResponseAvailableStops($availableItineraries);
        $availablePrices      = json_encode($this->AmadeusHelper->LowFarePlusResponseAvailablePrice($availableItineraries));
        $minimumPrice         = round($availableItineraries[0]['displayTotal'] /100);
        $lastItinerary        = count($availableItineraries) - 1;
        $maximumPrice         = round($availableItineraries[$lastItinerary]['displayTotal'] / 100);
        return view('pages.flight.search_result',compact('availableItineraries','availableCabins','availableAirlines','minimumPrice','maximumPrice','availableStops','availablePrices'));

    }

}
