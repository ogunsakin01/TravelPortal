<?php

namespace App\Http\Controllers;

use App\Services\AmadeusConfig;
use App\Services\AmadeusRequestXML;
use App\Services\AmadeusHelper;
use Illuminate\Http\Request;

class FlightController extends Controller
{

    private $AmadeusConfig;

    private $AmadeusRequestXML;

    private $AmadeusHelper;

    public function __construct(){
        $this->AmadeusConfig     = new AmadeusConfig();
        $this->AmadeusRequestXML = new AmadeusRequestXML();
        $this->AmadeusHelper     = new AmadeusHelper();
    }

    public function oneWayFlightSearch(Request $data){

        $requestXML = $this->AmadeusRequestXML->requestXML($this->AmadeusRequestXML->lowFarePlusRequestBodyXML($data));
        $this->AmadeusConfig->createXMlFile($requestXML,'LowFarePlusRQ.XML');
        $search = $this->AmadeusConfig->callAmadeus($this->AmadeusConfig->lowFareRequestHeader($requestXML),$requestXML,$this->AmadeusConfig->lowFarePlusRequestWebServiceUrl);
        $this->AmadeusConfig->createXMlFile($search,'LowFarePlusRS.XML');
        $responseArray = $this->AmadeusConfig->mungXmlToArray($search);
        $validatorResponse = $this->AmadeusHelper->lowFarePlusResponseValidator($responseArray);
        if($validatorResponse === 1){
            $sortedResponse = $this->AmadeusHelper->lowFarePlusResponseSort($responseArray);
            session()->put('availableItineraries',$responseArray);
        }

        return $validatorResponse;
    }

    public function roundTripFlightSearch(Request $data){
        return $data;
    }

    public function multiDestinationFlightSearch(Request $data){
         return $data;
    }


}
