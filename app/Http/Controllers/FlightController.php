<?php

namespace App\Http\Controllers;

use App\Services\AmadeusConfig;
use App\Services\AmadeusRequestXML;
use App\Services\AmadeusHelper;
use Illuminate\Http\Request;
use nilsenj\Toastr\Facades\Toastr;

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

        $requestXML = $this->AmadeusRequestXML->lowFarePlusRequestBodyXML($data);
        $this->AmadeusConfig->createXMlFile($requestXML,'LowFarePlusOneWayRQ.XML');
        $search = $this->AmadeusConfig->callAmadeus($this->AmadeusConfig->lowFareRequestHeader($requestXML),$requestXML,$this->AmadeusConfig->lowFarePlusRequestWebServiceUrl);
        $this->AmadeusConfig->createXMlFile($search,'LowFarePlusOneWayRS.XML');
        $responseArray = $this->AmadeusConfig->mungXmlToArray($search);
        $validatorResponse = $this->AmadeusHelper->lowFarePlusResponseValidator($responseArray);
        if($validatorResponse === 1){
            $sortedResponse = $this->AmadeusHelper->lowFarePlusResponseSort($responseArray);
            $searchParam    = [
                'no_of_adult' => $data['no_of_adult'],
                'no_of_infant' => $data['no_of_infant'],
                'no_of_child'  => $data['no_of_child']
            ];
            session()->put('flightSearchParam',$searchParam);
            session()->put('availableItineraries',$sortedResponse);
        }

        return $validatorResponse;
    }

    public function roundTripFlightSearch(Request $data){

        $requestXML = $this->AmadeusRequestXML->lowFarePlusRequestBodyXML($data);
        $this->AmadeusConfig->createXMlFile($requestXML,'LowFarePlusTurnAroundRQ.XML');
        $search = $this->AmadeusConfig->callAmadeus($this->AmadeusConfig->lowFareRequestHeader($requestXML),$requestXML,$this->AmadeusConfig->lowFarePlusRequestWebServiceUrl);
        $this->AmadeusConfig->createXMlFile($search,'LowFarePlusTurnAroundRS.XML');
        $responseArray = $this->AmadeusConfig->mungXmlToArray($search);
        $validatorResponse = $this->AmadeusHelper->lowFarePlusResponseValidator($responseArray);
        if($validatorResponse === 1){
          $sortedResponse = $this->AmadeusHelper->lowFarePlusResponseSort($responseArray);
          $searchParam    = [
              'no_of_adult' => $data['no_of_adult'],
              'no_of_infant' => $data['no_of_infant'],
              'no_of_child'  => $data['no_of_child']
          ];
          session()->put('flightSearchParam',$searchParam);
          session()->put('availableItineraries',$sortedResponse);
        }
        return $validatorResponse;
    }

    public function multiDestinationFlightSearch(Request $data){
        $requestXML = $this->AmadeusRequestXML->lowFarePlusMultiDestinationRequestBodyXML($data);
        $this->AmadeusConfig->createXMlFile($requestXML,'LowFarePlusMultiDestinationRQ.XML');
        $search = $this->AmadeusConfig->callAmadeus($this->AmadeusConfig->lowFareRequestHeader($requestXML),$requestXML,$this->AmadeusConfig->lowFarePlusRequestWebServiceUrl);
        $this->AmadeusConfig->createXMlFile($search,'LowFarePlusMultiDestinationRS.XML');
        $responseArray = $this->AmadeusConfig->mungXmlToArray($search);
        $validatorResponse = $this->AmadeusHelper->lowFarePlusResponseValidator($responseArray);
        if($validatorResponse === 1){
            $sortedResponse = $this->AmadeusHelper->lowFarePlusResponseSort($responseArray);
            Toastr::success(count($sortedResponse)." Result Found Matching Your Search. Browse through to find you best choice");
            $searchParam    = [
                'no_of_adult' => $data['searchParam']['no_of_adult'],
                'no_of_infant' => $data['searchParam']['no_of_infant'],
                'no_of_child'  => $data['searchParam']['no_of_child']
            ];
            session()->put('flightSearchParam',$searchParam);
            session()->put('availableItineraries',$sortedResponse);
        }
        return $validatorResponse;
    }

    public function selectedItineraryInfo($id){
        $availableItineraries = session()->get('availableItineraries');
        return json_encode($availableItineraries[$id]);
    }

    public function getItineraryInformationAndPricing($id){

        $selectedItinerary =  $this->selectedItineraryInfo($id);
        $searchParam       =  session()->get('flightSearchParam');
        $xml_post_string = $this->AmadeusRequestXML->airPriceRequestXML($selectedItinerary,$searchParam);
        $this->AmadeusConfig->createXMlFile($xml_post_string,'AirPriceRQ.XML');
        $getPricing = $this->AmadeusConfig->callAmadeus($this->AmadeusConfig->airPriceRequestHeader($xml_post_string),$xml_post_string,$this->AmadeusConfig->airPriceRequestWebServiceUrl);
        $this->AmadeusConfig->createXMlFile($getPricing,'AirPriceRS.XML');
        return $this->AmadeusConfig->mungXmlToArray($getPricing);

    }

}
