<?php
/**
 * Created by PhpStorm.
 * User: UniQue
 * Date: 4/11/2018
 * Time: 1:24 PM
 */

namespace App\Services;


use App\Markdown;
use App\Markup;
use App\Vat;

class AmadeusHelper
{

    private $AmadeusConfig;

    public function __construct(){
        $this->AmadeusConfig = new AmadeusConfig();
    }

    public function lowFarePlusResponseValidator($responseArray){
        if(empty($responseArray)){
            return 0;
        }else{
            if(isset($responseArray['soap_Body']['wmLowFarePlusResponse']['OTA_AirLowFareSearchPlusRS']['Success'])){
                return 1;
            }else{
                if(isset($responseArray['soap_Body']['wmLowFarePlusResponse']['OTA_AirLowFareSearchPlusRS']['Errors']['Error'])){
                    $error = $responseArray['soap_Body']['wmLowFarePlusResponse']['OTA_AirLowFareSearchPlusRS']['Errors']['Error'];
                    return [21 , $error];
                }else{
                    return 2;
                }
            }
        }
    }

    public function lowFarePlusResponseXMLValidator($responseXML){
        $responseData = simplexml_load_string($this->AmadeusConfig->mungXMl($responseXML));
        if(empty($responseData)){
            return 0;
        }else{
            if(isset($responseData->soap_Body->wmLowFarePlusResponse->OTA_AirLowFareSearchPlusRS->Success)){
                return 1;
            }else{
                if(isset($responseData->soap_Body->wmLowFarePlusResponse->OTA_AirLowFareSearchPlusRS->Errors->Error)){
                    $error = $responseData->soap_Body->wmLowFarePlusResponse->OTA_AirLowFareSearchPlusRS->Errors->Error;
                    return [21 , $error];
                }else{
                    return 2;
                }
            }
        }
    }

    public function priceTypeCalculator($type,$value,$amount){
        if($type == 2){
            return (($value/100) * $amount);
        }if($type == 1){
            return $value;
        }
    }

    public function lowFarePlusResponseSort($responseArray){

        $sortedResponse = [];

        $itineraries = $responseArray['soap_Body']['wmLowFarePlusResponse']['OTA_AirLowFareSearchPlusRS']['PricedItineraries']['PricedItinerary'];
        if(isset($itineraries[0])){
            foreach($itineraries as $itinerary_serial => $itinerary ){

                $originDestinationInfo = [];
                $defaultFareInfo = [];

                $originDestinations = $itinerary['AirItinerary']['OriginDestinationOptions']['OriginDestinationOption'];
                $fareInfoCount = 0;
                $stops = 0;
                $displayAirline = 0;
                $cabinType = 0;
                $originDestinationsCount = 0;
                if(isset($originDestinations[0])){
                    $originDestinationsCount = count($originDestinations);
                    $originDestinationPlacement = 1;
                    foreach($originDestinations as $i => $originDestination){

                        if(isset($originDestination['FlightSegment'][0])){
                            $stops = count($originDestination['FlightSegment']) - 1;
                            $displayAirline = $itinerary['AirItineraryPricingInfo']['FareInfos']['FareInfo'][0]['FilingAirline']['@attributes']['Code'];

                            $cabinType = $originDestination['FlightSegment'][0]['TPA_Extensions']['CabinType']['@attributes']['Cabin'];
                            foreach($originDestination['FlightSegment'] as $j => $flightSegment){
                                $dateDiff = intval((strtotime($flightSegment['@attributes']['ArrivalDateTime'])-strtotime($flightSegment['@attributes']['DepartureDateTime']))/60);
                                $hours = intval($dateDiff/60);
                                $minutes = $dateDiff%60;
                                $flightSegmentInfo = [
                                    'originDestinationPlacement'     =>  $originDestinationPlacement,
                                    'departureDateTime'     => $flightSegment['@attributes']['DepartureDateTime'],
                                    'arrivalDateTime'       => $flightSegment['@attributes']['ArrivalDateTime'],
                                    'flightNumber'          => $flightSegment['@attributes']['FlightNumber'],
                                    'resBookDesigCode'      => $flightSegment['@attributes']['ResBookDesigCode'],
                                    'departureAirportName'  => $flightSegment['DepartureAirport'],
                                    'arrivalAirportName'    => $flightSegment['ArrivalAirport'],
                                    'equipment'             => array_get(array_get($flightSegment['Equipment'],'',$flightSegment['Equipment']),'AirEquipType',array_get($flightSegment['Equipment'],'',$flightSegment['Equipment'])),
                                    'journeyDuration'       => $hours ." hr(s) ".$minutes." min(s)",
                                    'journeyTotalDuration'  => array_get($flightSegment['TPA_Extensions'],'JourneyTotalDuration',0),
                                    'cabin'                 => $flightSegment['TPA_Extensions']['CabinType']['@attributes']['Cabin'],
                                    'operatingAirlineName'  => $flightSegment['OperatingAirline'],
                                    'marketingAirline'      => $flightSegment['MarketingAirline'],
                                    'departureAirportCode'  => $itinerary['AirItineraryPricingInfo']['FareInfos']['FareInfo'][$fareInfoCount]['DepartureAirport']['@attributes']['LocationCode'],
                                    'arrivalAirportCode'    => $itinerary['AirItineraryPricingInfo']['FareInfos']['FareInfo'][$fareInfoCount]['ArrivalAirport']['@attributes']['LocationCode'],
                                    'filingAirlineCode'    =>  $itinerary['AirItineraryPricingInfo']['FareInfos']['FareInfo'][$fareInfoCount]['FilingAirline']['@attributes']['Code']
                                ];
                                 $fareInfoCount = $fareInfoCount +1;
                                array_push($originDestinationInfo , $flightSegmentInfo);
                            }
                        }

                        else{
                            $stops = 0;
                            if(isset($itinerary['AirItineraryPricingInfo']['FareInfos']['FareInfo'][0])){
                                $displayAirline = $itinerary['AirItineraryPricingInfo']['FareInfos']['FareInfo'][0]['FilingAirline']['@attributes']['Code'];
                            }else{
                                $displayAirline = $itinerary['AirItineraryPricingInfo']['FareInfos']['FareInfo']['FilingAirline']['@attributes']['Code'];
                            }
                            $cabinType = $originDestination['FlightSegment']['TPA_Extensions']['CabinType']['@attributes']['Cabin'];
                            $flightSegment = $originDestination['FlightSegment'];
                            $dateDiff = intval((strtotime($flightSegment['@attributes']['ArrivalDateTime'])-strtotime($flightSegment['@attributes']['DepartureDateTime']))/60);
                            $hours = intval($dateDiff/60);
                            $minutes = $dateDiff%60;
                            $flightSegmentInfo = [
                                'originDestinationPlacement'     =>  $originDestinationPlacement,
                                'departureDateTime'     => $flightSegment['@attributes']['DepartureDateTime'],
                                'arrivalDateTime'       => $flightSegment['@attributes']['ArrivalDateTime'],
                                'flightNumber'          => $flightSegment['@attributes']['FlightNumber'],
                                'resBookDesigCode'      => $flightSegment['@attributes']['ResBookDesigCode'],
                                'departureAirportName'  => $flightSegment['DepartureAirport'],
                                'arrivalAirportName'    => $flightSegment['ArrivalAirport'],
                                'equipment'             => array_get(array_get($flightSegment['Equipment'],'',$flightSegment['Equipment']),'AirEquipType',array_get($flightSegment['Equipment'],'',$flightSegment['Equipment'])),
                                'journeyDuration'       => $hours ." hr(s) ".$minutes." min(s)",
                                'journeyTotalDuration'  => array_get($flightSegment['TPA_Extensions'],'JourneyTotalDuration',0),
                                'cabin'                 => $flightSegment['TPA_Extensions']['CabinType']['@attributes']['Cabin'],
                                'operatingAirlineName'  => $flightSegment['OperatingAirline'],
                                'marketingAirline'      => $flightSegment['MarketingAirline'],
                                'departureAirportCode'  => $itinerary['AirItineraryPricingInfo']['FareInfos']['FareInfo'][$fareInfoCount]['DepartureAirport']['@attributes']['LocationCode'],
                                'arrivalAirportCode'    => $itinerary['AirItineraryPricingInfo']['FareInfos']['FareInfo'][$fareInfoCount]['ArrivalAirport']['@attributes']['LocationCode'],
                                'filingAirlineCode'    =>  $itinerary['AirItineraryPricingInfo']['FareInfos']['FareInfo'][$fareInfoCount]['FilingAirline']['@attributes']['Code']
                            ];
                            $fareInfoCount = $fareInfoCount +1;
                            array_push($originDestinationInfo , $flightSegmentInfo);
                        }

                        $originDestinationPlacement = $originDestinationPlacement + 1;
                    }
                }
                else{
                    $originDestination = $originDestinations;
                    $originDestinationsCount = 1;
                    if(isset($originDestination['FlightSegment'][0])){
                        $stops = count($originDestination['FlightSegment']) - 1;
                        $cabinType = $originDestination['FlightSegment'][0]['TPA_Extensions']['CabinType']['@attributes']['Cabin'];
                        $displayAirline = $itinerary['AirItineraryPricingInfo']['FareInfos']['FareInfo'][0]['FilingAirline']['@attributes']['Code'];
                        foreach($originDestination['FlightSegment'] as $j => $flightSegment){
                            $dateDiff = intval((strtotime($flightSegment['@attributes']['ArrivalDateTime'])-strtotime($flightSegment['@attributes']['DepartureDateTime']))/60);
                            $hours = intval($dateDiff/60);
                            $minutes = $dateDiff%60;


                            $flightSegmentInfo = [
                                'originDestinationPlacement'     =>  1,
                                'departureDateTime'     => $flightSegment['@attributes']['DepartureDateTime'],
                                'arrivalDateTime'       => $flightSegment['@attributes']['ArrivalDateTime'],
                                'flightNumber'          => $flightSegment['@attributes']['FlightNumber'],
                                'resBookDesigCode'      => $flightSegment['@attributes']['ResBookDesigCode'],
                                'departureAirportName'  => $flightSegment['DepartureAirport'],
                                'arrivalAirportName'    => $flightSegment['ArrivalAirport'],
                                'equipment'             => array_get(array_get($flightSegment['Equipment'],'',$flightSegment['Equipment']),'AirEquipType',array_get($flightSegment['Equipment'],'',$flightSegment['Equipment'])),
                                'journeyDuration'       => $hours ." hr(s) ".$minutes." min(s)",
                                'journeyTotalDuration'  => array_get($flightSegment['TPA_Extensions'],'JourneyTotalDuration',0),
                                'cabin'                 => $flightSegment['TPA_Extensions']['CabinType']['@attributes']['Cabin'],
                                'operatingAirlineName'  => $flightSegment['OperatingAirline'],
                                'marketingAirline'      => $flightSegment['MarketingAirline'],
                                'departureAirportCode'  => $itinerary['AirItineraryPricingInfo']['FareInfos']['FareInfo'][$fareInfoCount]['DepartureAirport']['@attributes']['LocationCode'],
                                'arrivalAirportCode'    => $itinerary['AirItineraryPricingInfo']['FareInfos']['FareInfo'][$fareInfoCount]['ArrivalAirport']['@attributes']['LocationCode'],
                                'filingAirlineCode'    =>  $itinerary['AirItineraryPricingInfo']['FareInfos']['FareInfo'][$fareInfoCount]['FilingAirline']['@attributes']['Code']
                            ];
                            $fareInfoCount = $fareInfoCount +1;
                            array_push($originDestinationInfo , $flightSegmentInfo);
                        }
                    }
                    else{
                        $flightSegment = $originDestination['FlightSegment'];
                        $stops = 0;
                        $cabinType = $originDestination['FlightSegment']['TPA_Extensions']['CabinType']['@attributes']['Cabin'];
                        if(isset($itinerary['AirItineraryPricingInfo']['FareInfos']['FareInfo'][0])){
                            $displayAirline = $itinerary['AirItineraryPricingInfo']['FareInfos']['FareInfo'][0]['FilingAirline']['@attributes']['Code'];
                        }else{
                            $displayAirline = $itinerary['AirItineraryPricingInfo']['FareInfos']['FareInfo']['FilingAirline']['@attributes']['Code'];
                        }
                        $dateDiff = intval((strtotime($flightSegment['@attributes']['ArrivalDateTime'])-strtotime($flightSegment['@attributes']['DepartureDateTime']))/60);
                        $hours = intval($dateDiff/60);
                        $minutes = $dateDiff%60;

                        $flightSegmentInfo = [
                            'originDestinationPlacement'     =>  1,
                            'departureDateTime'     => $flightSegment['@attributes']['DepartureDateTime'],
                            'arrivalDateTime'       => $flightSegment['@attributes']['ArrivalDateTime'],
                            'flightNumber'          => $flightSegment['@attributes']['FlightNumber'],
                            'resBookDesigCode'      => $flightSegment['@attributes']['ResBookDesigCode'],
                            'departureAirportName'  => $flightSegment['DepartureAirport'],
                            'arrivalAirportName'    => $flightSegment['ArrivalAirport'],
                            'equipment'             => array_get(array_get($flightSegment['Equipment'],'',$flightSegment['Equipment']),'AirEquipType',array_get($flightSegment['Equipment'],'',$flightSegment['Equipment'])),
                            'journeyDuration'       => $hours ." hr(s) ".$minutes." min(s)",
                            'journeyTotalDuration'  => array_get($flightSegment['TPA_Extensions'],'JourneyTotalDuration',0),
                            'cabin'                 => $flightSegment['TPA_Extensions']['CabinType']['@attributes']['Cabin'],
                            'operatingAirlineName'  => $flightSegment['OperatingAirline'],
                            'marketingAirline'      => $flightSegment['MarketingAirline'],
                            'departureAirportCode'  => $itinerary['AirItineraryPricingInfo']['FareInfos']['FareInfo'][$fareInfoCount]['DepartureAirport']['@attributes']['LocationCode'],
                            'arrivalAirportCode'    => $itinerary['AirItineraryPricingInfo']['FareInfos']['FareInfo'][$fareInfoCount]['ArrivalAirport']['@attributes']['LocationCode'],
                            'filingAirlineCode'    =>  $itinerary['AirItineraryPricingInfo']['FareInfos']['FareInfo'][$fareInfoCount]['FilingAirline']['@attributes']['Code']
                        ];
                        $fareInfoCount = $fareInfoCount +1;
                        array_push($originDestinationInfo , $flightSegmentInfo);
                    }
                }

                $fareBrakeDowns = $itinerary['AirItineraryPricingInfo']['PTC_FareBreakdowns']['PTC_FareBreakdown'];
                if(isset($fareBrakeDowns[0])){
                    foreach($fareBrakeDowns as $serial => $brakeDown){
                        $bags = [];
                        if(isset($brakeDown['PassengerFare']['FreeBagAllowance'])){
                            $baggageAllowances = $brakeDown['PassengerFare']['FreeBagAllowance'];
                            if(isset($baggageAllowaces[0])){
                                foreach($baggageAllowances as $b => $baggageAllowance){
                                    $baggageAllowanceInfo = array_get($baggageAllowance, 'Weight',array_get($baggageAllowance[''],'Quantity',0));
                                    $baggageUnit          = array_get($baggageAllowance,'Unit',array_get($baggageAllowance[''],'Type',0));
                                    $bagArray = $baggageAllowanceInfo."-".$baggageUnit;
                                    array_push($bags, $bagArray);
                                }
                            }else{
                                $baggageAllowance = $baggageAllowances;
                                    $baggageAllowanceInfo = array_get($baggageAllowance, 'Weight',array_get($baggageAllowance,'Quantity',0));
                                    $baggageUnit          = array_get($baggageAllowance,'Unit',array_get($baggageAllowance,'Type',0));
                                    $bagArray = $baggageAllowanceInfo."-".$baggageUnit;
                                    array_push($bags, $bagArray);

                            }
                        }

                      $fareBrakeDownInfo = [
                          'passengerType' => $brakeDown['PassengerTypeQuantity']['@attributes']['Code'],
                          'quantity'      => $brakeDown['PassengerTypeQuantity']['@attributes']['Quantity'],
                          'price'         => $brakeDown['PassengerFare']['TotalFare']['@attributes']['Amount'],
                          'freeBagAllowance' => $bags,
                      ];
                      array_push($defaultFareInfo, $fareBrakeDownInfo);
                    }
                }
                else{
                    $brakeDown = $fareBrakeDowns;
                    $fareBrakeDownInfo = [
                        'passengerType' => $brakeDown['PassengerTypeQuantity']['@attributes']['Code'],
                        'quantity'      => $brakeDown['PassengerTypeQuantity']['@attributes']['Quantity'],
                        'price'         => $brakeDown['PassengerFare']['TotalFare']['@attributes']['Amount'],
                    ];
                    array_push($defaultFareInfo, $fareBrakeDownInfo);
                }

                $itineraryDefaultPrice = $itinerary['AirItineraryPricingInfo']['ItinTotalFare']['TotalFare']['@attributes']['Amount'];
                $customerMarkup        = 0;
                $agentMarkup           = 0;
                $adminMarkup           = 0;
                $vat                   = 0;
                $airlineMarkdown       = 0;
                $customerTotal         = 0;
                $agentTotal            = 0;
                $adminTotal            = 0;
                $displayTotal          = 0;


                $agentMarkupInfo    = Markup::where('role_id', 2)->first();
                $customerMarkupInfo = Markup::where('role_id', 3)->first();
                $vatInfo            = Vat::where('id',1)->first();
                $markdownInfo       = Markdown::where('airline_code',$itinerary['AirItineraryPricingInfo']['@attributes']['ValidatingAirlineCode'])->first();
                if(!is_null($markdownInfo)){
                   $airlineMarkdown = $this->priceTypeCalculator($markdownInfo->type,$markdownInfo->type,$itineraryDefaultPrice);
                }
                $agentMarkup    = $this->priceTypeCalculator($agentMarkupInfo->flight_markup_type,$agentMarkupInfo->flight_markup_type,$itineraryDefaultPrice);
                $customerMarkup = $this->priceTypeCalculator($customerMarkupInfo->flight_markup_type,$customerMarkupInfo->flight_markup_type,$itineraryDefaultPrice);
                $adminMarkup    = 0;
                $vat            = $this->priceTypeCalculator($vatInfo->flight_vat_type,$vatInfo->flight_vat_type,$itineraryDefaultPrice);

                $customerTotal = ($itineraryDefaultPrice + $customerMarkup + $vat) - $airlineMarkdown;
                $agentTotal    = ($itineraryDefaultPrice + $agentMarkup + $vat) - $airlineMarkdown;
                $adminTotal    = ($itineraryDefaultPrice + $adminMarkup + $vat) - $airlineMarkdown;

                if(auth()->guest()){
                    $displayTotal = $customerTotal;
                }else{
                    if(auth()->user()->hasRole('admin')){
                        $displayTotal = $adminTotal;
                    }elseif(auth()->user()->hasRole('agent')){
                        $displayTotal = $agentTotal;
                    }elseif(auth()->user()->hasRole('customer')){
                        $displayTotal = $customerTotal;
                    }
                }

                $itineraryInformation = [
                    'directionInd'             => $itinerary['AirItinerary']['@attributes']['DirectionInd'],
                    'ticketTimeLimit'          => $itinerary['TicketingInfo']['@attributes']['TicketTimeLimit'],
                    'pricingSource'            => $itinerary['AirItineraryPricingInfo']['@attributes']['PricingSource'],
                    'validatingAirlineCode'    => $itinerary['AirItineraryPricingInfo']['@attributes']['ValidatingAirlineCode'],
                    'defaultItineraryPrice'    => $itineraryDefaultPrice,
                    'originDestinationsCount'  => $originDestinationsCount,
                    'cabinType'                => $cabinType,
                    'stops'                    => $stops,
                    'displayAirline'           => $displayAirline,
                    'adminToCustomerMarkup'    => $customerMarkup,
                    'adminToAgentMarkup'       => $agentMarkup,
                    'adminToAdminMarkup'       => $adminMarkup,
                    'vat'                      => $vat,
                    'airlineMarkdown'          => $airlineMarkdown,
                    'customerTotal'            => $customerTotal,
                    'agentTotal'               => $agentTotal,
                    'adminTotal'               => $adminTotal,
                    'displayTotal'             => $displayTotal,
                    'itineraryPassengerInfo'   => $defaultFareInfo,
                    'originDestinations'       => $originDestinationInfo
                ];

                array_push($sortedResponse,$itineraryInformation);
            }
        }else{
            $itinerary = $itineraries;



        }

        return $sortedResponse;

    }

    public function lowFarePlusResponseSortFromXML($responseXML){

        $responseData = simplexml_load_string($this->AmadeusConfig->mungXMl($responseXML));

        $sortedResponse = [];

        $itineraries = $responseData->soap_Body->wmLowFarePlusResponse->OTA_AirLowFareSearchPlusRS->PricedItineraries->PricedItinerary;

        if(isset($itineraries[0])){
            foreach($itineraries as $itinerary_serial => $itinerary ){

                $originDestinationInfo = [];
                $defaultFareInfo = [];

                $originDestinations = $itinerary->AirItinerary->OriginDestinationOptions->OriginDestinationOption;
                $fareInfoCount = 0;
                $stops = 0;
                $displayAirline = 0;
                $cabinType = 0;
                $originDestinationsCount = 0;
                if(isset($originDestinations[0])){
                    $originDestinationsCount = count($originDestinations);
                    $originDestinationPlacement = 1;
                    foreach($originDestinations as $i => $originDestination){

                        if(isset($originDestination->FlightSegment[0])){
                            $stops = count($originDestination->FlightSegment) - 1;
                            $displayAirline = $originDestination->FlightSegment[0]->MarketingAirline->attributes()->Code[0];

                            $cabinType = $originDestination->FlightSegment[0]->TPA_Extensions->CabinType->attributes()->Cabin[0];
                            foreach($originDestination->FlightSegment as $j => $flightSegment){
                                $dateDiff = intval((strtotime($flightSegment['ArrivalDateTime'])-strtotime($flightSegment['DepartureDateTime']))/60);
                                $hours = intval($dateDiff/60);
                                $minutes = $dateDiff%60;

                                $flightSegmentInfo = [
                                    'originDestinationPlacement'     =>  $originDestinationPlacement,
                                    'departureDateTime'     => $flightSegment['DepartureDateTime'],
                                    'arrivalDateTime'       => $flightSegment['ArrivalDateTime'],
                                    'flightNumber'          => $flightSegment['FlightNumber'],
                                    'resBookDesigCode'      => $flightSegment['ResBookDesigCode'],
                                    'departureAirportName'  => $flightSegment->DepartureAirport,
                                    'arrivalAirportName'    => $flightSegment->ArrivalAirport,
                                    'equipment'             => $flightSegment->Equipment[0],
                                    'journeyDuration'       => $hours ." hr(s) ".$minutes." min(s)",
                                    'journeyTotalDuration'  => $flightSegment->TPA_Extensions->JourneyTotalDuration,
                                    'cabin'                 => $flightSegment->TPA_Extensions->CabinType->attributes()->Cabin[0],
                                    'operatingAirlineName'  => $flightSegment->OperatingAirline[0],
                                    'marketingAirline'      => $flightSegment->MarketingAirline[0],
                                    'operatingAirlineCode'  => $flightSegment->OperatingAirline->attributes()->Code[0],
                                    'marketingAirlineCode'  => $flightSegment->MarketingAirline->attributes()->Code[0],
                                    'departureAirportCode'  => $itinerary->AirItineraryPricingInfo->FareInfos->FareInfo[$fareInfoCount]->DepartureAirport->attributes()->LocationCode[0],
                                    'arrivalAirportCode'    => $itinerary->AirItineraryPricingInfo->FareInfos->FareInfo[$fareInfoCount]->ArrivalAirport->attributes()->LocationCode[0],
                                    'filingAirlineCode'    =>  $itinerary->AirItineraryPricingInfo->FareInfos->FareInfo[$fareInfoCount]->FilingAirline->attributes()->Code[0]
                                ];
                                $fareInfoCount = $fareInfoCount +1;
                                array_push($originDestinationInfo , $flightSegmentInfo);
                            }
                        }

                        else{
                            $stops = 0;
                            $displayAirline = $originDestination->FlightSegment->MarketingAirline->attributes()->Code[0];
                            $cabinType = $originDestination->FlightSegment->TPA_Extensions->CabinType->attributes()->Cabin[0];
                            $flightSegment = $originDestination->FlightSegment;
                            $dateDiff = intval((strtotime($flightSegment['ArrivalDateTime'])-strtotime($flightSegment['DepartureDateTime']))/60);
                            $hours = intval($dateDiff/60);
                            $minutes = $dateDiff%60;
                            $flightSegmentInfo = [
                                'originDestinationPlacement'     =>  $originDestinationPlacement,
                                'departureDateTime'     => $flightSegment['DepartureDateTime'],
                                'arrivalDateTime'       => $flightSegment['ArrivalDateTime'],
                                'flightNumber'          => $flightSegment['FlightNumber'],
                                'resBookDesigCode'      => $flightSegment['ResBookDesigCode'],
                                'departureAirportName'  => $flightSegment->DepartureAirport,
                                'arrivalAirportName'    => $flightSegment->ArrivalAirport,
                                'equipment'             => $flightSegment->Equipment[0],
                                'journeyDuration'       => $hours ." hr(s) ".$minutes." min(s)",
                                'journeyTotalDuration'  => $flightSegment->TPA_Extensions->JourneyTotalDuration,
                                'cabin'                 => $flightSegment->TPA_Extensions->CabinType->attributes()->Cabin[0],
                                'operatingAirlineName'  => $flightSegment->OperatingAirline[0],
                                'marketingAirline'      => $flightSegment->MarketingAirline[0],
                                'operatingAirlineCode'  => $flightSegment->OperatingAirline->attributes()->Code[0],
                                'marketingAirlineCode'  => $flightSegment->MarketingAirline->attributes()->Code[0],
                                'departureAirportCode'  => $itinerary->AirItineraryPricingInfo->FareInfos->FareInfo[$fareInfoCount]->DepartureAirport->attributes()->LocationCode[0],
                                'arrivalAirportCode'    => $itinerary->AirItineraryPricingInfo->FareInfos->FareInfo[$fareInfoCount]->ArrivalAirport->attributes()->LocationCode[0],
                                'filingAirlineCode'    =>  $itinerary->AirItineraryPricingInfo->FareInfos->FareInfo[$fareInfoCount]->FilingAirline->attributes()->Code[0]
                            ];
                            $fareInfoCount = $fareInfoCount +1;
                            array_push($originDestinationInfo , $flightSegmentInfo);
                        }

                        $originDestinationPlacement = $originDestinationPlacement + 1;
                    }
                }
                else{
                    $originDestination = $originDestinations;
                    $originDestinationsCount = 1;
                    if(isset($originDestination->FlightSegment[0])){
                        $stops = count($originDestination->FlightSegment) - 1;
                        $cabinType = $originDestination->FlightSegment[0]->TPA_Extensions->CabinType->attributes()->Cabin[0];
                        $displayAirline = $originDestination->FlightSegment[0]->MarketingAirline->attributes()->Code[0];
                        foreach($originDestination['FlightSegment'] as $j => $flightSegment){
                            $dateDiff = intval((strtotime($flightSegment['ArrivalDateTime'])-strtotime($flightSegment['DepartureDateTime']))/60);
                            $hours = intval($dateDiff/60);
                            $minutes = $dateDiff%60;


                            $flightSegmentInfo = [
                                'originDestinationPlacement'     =>  1,
                                'departureDateTime'     => $flightSegment['DepartureDateTime'],
                                'arrivalDateTime'       => $flightSegment['ArrivalDateTime'],
                                'flightNumber'          => $flightSegment['FlightNumber'],
                                'resBookDesigCode'      => $flightSegment['ResBookDesigCode'],
                                'departureAirportName'  => $flightSegment->DepartureAirport,
                                'arrivalAirportName'    => $flightSegment->ArrivalAirport,
                                'equipment'             => $flightSegment->Equipment[0],
                                'journeyDuration'       => $hours ." hr(s) ".$minutes." min(s)",
                                'journeyTotalDuration'  => $flightSegment->TPA_Extensions->JourneyTotalDuration,
                                'cabin'                 => $flightSegment->TPA_Extensions->CabinType->attributes()->Cabin[0],
                                'operatingAirlineName'  => $flightSegment->OperatingAirline[0],
                                'marketingAirline'      => $flightSegment->MarketingAirline[0],
                                'operatingAirlineCode'  => $flightSegment->OperatingAirline->attributes()->Code[0],
                                'marketingAirlineCode'  => $flightSegment->MarketingAirline->attributes()->Code[0],
                                'departureAirportCode'  => $itinerary->AirItineraryPricingInfo->FareInfos->FareInfo[$fareInfoCount]->DepartureAirport->attributes()->LocationCode[0],
                                'arrivalAirportCode'    => $itinerary->AirItineraryPricingInfo->FareInfos->FareInfo[$fareInfoCount]->ArrivalAirport->attributes()->LocationCode[0],
                                'filingAirlineCode'    =>  $itinerary->AirItineraryPricingInfo->FareInfos->FareInfo[$fareInfoCount]->FilingAirline->attributes()->Code[0]
                            ];
                            $fareInfoCount = $fareInfoCount +1;
                            array_push($originDestinationInfo , $flightSegmentInfo);
                        }
                    }
                    else{
                        $flightSegment = $originDestination->FlightSegment;
                        $stops = 0;
                        $cabinType = $originDestination->FlightSegment->TPA_Extensions->CabinType->attributes()->Cabin[0];
                        $displayAirline = $originDestination->FlightSegment->MarketingAirline->attributes()->Code[0];
                        $dateDiff = intval((strtotime($flightSegment['ArrivalDateTime'])-strtotime($flightSegment['DepartureDateTime']))/60);
                        $hours = intval($dateDiff/60);
                        $minutes = $dateDiff%60;

                        $flightSegmentInfo = [
                            'originDestinationPlacement'     =>  1,
                            'departureDateTime'     => $flightSegment['DepartureDateTime'],
                            'arrivalDateTime'       => $flightSegment['ArrivalDateTime'],
                            'flightNumber'          => $flightSegment['FlightNumber'],
                            'resBookDesigCode'      => $flightSegment['ResBookDesigCode'],
                            'departureAirportName'  => $flightSegment->DepartureAirport,
                            'arrivalAirportName'    => $flightSegment->ArrivalAirport,
                            'equipment'             => $flightSegment->Equipment[0],
                            'journeyDuration'       => $hours ." hr(s) ".$minutes." min(s)",
                            'journeyTotalDuration'  => $flightSegment->TPA_Extensions->JourneyTotalDuration,
                            'cabin'                 => $flightSegment->TPA_Extensions->CabinType->attributes()->Cabin[0],
                            'operatingAirlineName'  => $flightSegment->OperatingAirline[0],
                            'marketingAirline'      => $flightSegment->MarketingAirline[0],
                            'operatingAirlineCode'  => $flightSegment->OperatingAirline->attributes()->Code[0],
                            'marketingAirlineCode'  => $flightSegment->MarketingAirline->attributes()->Code[0],
                            'departureAirportCode'  => $itinerary->AirItineraryPricingInfo->FareInfos->FareInfo[$fareInfoCount]->DepartureAirport->attributes()->LocationCode[0],
                            'arrivalAirportCode'    => $itinerary->AirItineraryPricingInfo->FareInfos->FareInfo[$fareInfoCount]->ArrivalAirport->attributes()->LocationCode[0],
                            'filingAirlineCode'    =>  $itinerary->AirItineraryPricingInfo->FareInfos->FareInfo[$fareInfoCount]->FilingAirline->attributes()->Code[0]
                        ];
                        $fareInfoCount = $fareInfoCount +1;
                        array_push($originDestinationInfo , $flightSegmentInfo);
                    }
                }

                $fareBrakeDowns = $itinerary->AirItineraryPricingInfo->PTC_FareBreakdowns->PTC_FareBreakdown;
                if(isset($fareBrakeDowns[0])){
                    foreach($fareBrakeDowns as $serial => $brakeDown){
                        $bags = [];
                        if(isset($brakeDown->PassengerFare->FreeBagAllowance)){
                            $baggageAllowances = $brakeDown->PassengerFare->FreeBagAllowance;
                            if(isset($baggageAllowaces[0])){
                                foreach($baggageAllowances as $b => $baggageAllowance){
                                    $baggageAllowanceInfo = array_get($baggageAllowance, 'Weight',array_get($baggageAllowance[''],'Quantity',0));
                                    $baggageUnit          = array_get($baggageAllowance,'Unit',array_get($baggageAllowance[''],'Type',0));
                                    $bagArray = $baggageAllowanceInfo."-".$baggageUnit;
                                    array_push($bags, $bagArray);
                                }
                            }else{
                                $baggageAllowance = $baggageAllowances;
                                $baggageAllowanceInfo = array_get($baggageAllowance, 'Weight',array_get($baggageAllowance,'Quantity',0));
                                $baggageUnit          = array_get($baggageAllowance,'Unit',array_get($baggageAllowance,'Type',0));
                                $bagArray = $baggageAllowanceInfo."-".$baggageUnit;
                                array_push($bags, $bagArray);

                            }
                        }

                        $fareBrakeDownInfo = [
                            'passengerType' => $brakeDown->PassengerTypeQuantity->attributes()->Code[0],
                            'quantity'      => $brakeDown->PassengerTypeQuantity->attributes()->Quantity[0],
                            'price'         => $brakeDown->PassengerFare->TotalFare->attributes()->Amount[0],
                            'freeBagAllowance' => $bags,
                        ];
                        array_push($defaultFareInfo, $fareBrakeDownInfo);
                    }
                }
                else{
                    $brakeDown = $fareBrakeDowns;
                    $fareBrakeDownInfo = [
                        'passengerType' => $brakeDown->PassengerTypeQuantity->attributes()->Code[0],
                        'quantity'      => $brakeDown->PassengerTypeQuantity->attributes()->Quantity[0],
                        'price'         => $brakeDown->PassengerFare->TotalFare->attributes()->Amount[0],
                    ];
                    array_push($defaultFareInfo, $fareBrakeDownInfo);
                }

                $itineraryDefaultPrice = $itinerary->AirItineraryPricingInfo->ItinTotalFare->TotalFare->attributes()->Amount[0];
                $customerMarkup        = 0;
                $agentMarkup           = 0;
                $adminMarkup           = 0;
                $vat                   = 0;
                $airlineMarkdown       = 0;
                $customerTotal         = 0;
                $agentTotal            = 0;
                $adminTotal            = 0;
                $displayTotal          = 0;


                $agentMarkupInfo    = Markup::where('role_id', 2)->first();
                $customerMarkupInfo = Markup::where('role_id', 3)->first();
                $vatInfo            = Vat::where('id',1)->first();
                $markdownInfo       = Markdown::where('airline_code',$itinerary->AirItineraryPricingInfo->attributes()->ValidatingAirlineCode[0])->first();
                if(!is_null($markdownInfo)){
                    $airlineMarkdown = $this->priceTypeCalculator($markdownInfo->type,$markdownInfo->type,$itineraryDefaultPrice);
                }
                $agentMarkup    = $this->priceTypeCalculator($agentMarkupInfo->flight_markup_type,$agentMarkupInfo->flight_markup_type,$itineraryDefaultPrice);
                $customerMarkup = $this->priceTypeCalculator($customerMarkupInfo->flight_markup_type,$customerMarkupInfo->flight_markup_type,$itineraryDefaultPrice);
                $adminMarkup    = 0;
                $vat            = $this->priceTypeCalculator($vatInfo->flight_vat_type,$vatInfo->flight_vat_type,$itineraryDefaultPrice);

                $customerTotal = ($itineraryDefaultPrice + $customerMarkup + $vat) - $airlineMarkdown;
                $agentTotal    = ($itineraryDefaultPrice + $agentMarkup + $vat) - $airlineMarkdown;
                $adminTotal    = ($itineraryDefaultPrice + $adminMarkup + $vat) - $airlineMarkdown;

                if(auth()->guest()){
                    $displayTotal = $customerTotal;
                }
                else{
                    if(auth()->user()->hasRole('admin')){
                        $displayTotal = $adminTotal;
                    }elseif(auth()->user()->hasRole('agent')){
                        $displayTotal = $agentTotal;
                    }elseif(auth()->user()->hasRole('customer')){
                        $displayTotal = $customerTotal;
                    }
                }

                $itineraryInformation = [
                    'directionInd'             => $itinerary->AirItinerary->attributes()->DirectionInd[0],
                    'ticketTimeLimit'          => $itinerary->TicketingInfo->attributes()->TicketTimeLimit[0],
                    'pricingSource'            => $itinerary->AirItineraryPricingInfo->attributes()->PricingSource[0],
                    'validatingAirlineCode'    => $itinerary->AirItineraryPricingInfo->attributes()->ValidatingAirlineCode[0],
                    'defaultItineraryPrice'    => $itineraryDefaultPrice,
                    'originDestinationsCount'  => $originDestinationsCount,
                    'cabinType'                => $cabinType,
                    'stops'                    => $stops,
                    'displayAirline'           => $displayAirline,
                    'adminToCustomerMarkup'    => $customerMarkup,
                    'adminToAgentMarkup'       => $agentMarkup,
                    'adminToAdminMarkup'       => $adminMarkup,
                    'vat'                      => $vat,
                    'airlineMarkdown'          => $airlineMarkdown,
                    'customerTotal'            => $customerTotal,
                    'agentTotal'               => $agentTotal,
                    'adminTotal'               => $adminTotal,
                    'displayTotal'             => $displayTotal,
                    'itineraryPassengerInfo'   => $defaultFareInfo,
                    'originDestinations'       => $originDestinationInfo
                ];

                array_push($sortedResponse,$itineraryInformation);
            }
        }

        else{
            $itinerary = $itineraries;


            $originDestinationInfo = [];
            $defaultFareInfo = [];

            $originDestinations = $itinerary->AirItinerary->OriginDestinationOptions->OriginDestinationOption;
            $fareInfoCount = 0;
            $stops = 0;
            $displayAirline = 0;
            $cabinType = 0;
            $originDestinationsCount = 0;
            if(isset($originDestinations[0])){
                $originDestinationsCount = count($originDestinations);
                $originDestinationPlacement = 1;
                foreach($originDestinations as $i => $originDestination){

                    if(isset($originDestination->FlightSegment[0])){
                        $stops = count($originDestination->FlightSegment) - 1;
                        $displayAirline = $originDestination->FlightSegment[0]->MarketingAirline->attributes()->Code[0];

                        $cabinType = $originDestination->FlightSegment[0]->TPA_Extensions->CabinType->attributes()->Cabin[0];
                        foreach($originDestination->FlightSegment as $j => $flightSegment){
                            $dateDiff = intval((strtotime($flightSegment['ArrivalDateTime'])-strtotime($flightSegment['DepartureDateTime']))/60);
                            $hours = intval($dateDiff/60);
                            $minutes = $dateDiff%60;

                            $flightSegmentInfo = [
                                'originDestinationPlacement'     =>  $originDestinationPlacement,
                                'departureDateTime'     => $flightSegment['DepartureDateTime'],
                                'arrivalDateTime'       => $flightSegment['ArrivalDateTime'],
                                'flightNumber'          => $flightSegment['FlightNumber'],
                                'resBookDesigCode'      => $flightSegment['ResBookDesigCode'],
                                'departureAirportName'  => $flightSegment->DepartureAirport,
                                'arrivalAirportName'    => $flightSegment->ArrivalAirport,
                                'equipment'             => $flightSegment->Equipment[0],
                                'journeyDuration'       => $hours ." hr(s) ".$minutes." min(s)",
                                'journeyTotalDuration'  => $flightSegment->TPA_Extensions->JourneyTotalDuration,
                                'cabin'                 => $flightSegment->TPA_Extensions->CabinType->attributes()->Cabin[0],
                                'operatingAirlineName'  => $flightSegment->OperatingAirline[0],
                                'marketingAirline'      => $flightSegment->MarketingAirline[0],
                                'operatingAirlineCode'  => $flightSegment->OperatingAirline->attributes()->Code[0],
                                'marketingAirlineCode'  => $flightSegment->MarketingAirline->attributes()->Code[0],
                                'departureAirportCode'  => $itinerary->AirItineraryPricingInfo->FareInfos->FareInfo[$fareInfoCount]->DepartureAirport->attributes()->LocationCode[0],
                                'arrivalAirportCode'    => $itinerary->AirItineraryPricingInfo->FareInfos->FareInfo[$fareInfoCount]->ArrivalAirport->attributes()->LocationCode[0],
                                'filingAirlineCode'    =>  $itinerary->AirItineraryPricingInfo->FareInfos->FareInfo[$fareInfoCount]->FilingAirline->attributes()->Code[0]
                            ];
                            $fareInfoCount = $fareInfoCount +1;
                            array_push($originDestinationInfo , $flightSegmentInfo);
                        }
                    }

                    else{
                        $stops = 0;
                        $displayAirline = $originDestination->FlightSegment->MarketingAirline->attributes()->Code[0];
                        $cabinType = $originDestination->FlightSegment->TPA_Extensions->CabinType->attributes()->Cabin[0];
                        $flightSegment = $originDestination->FlightSegment;
                        $dateDiff = intval((strtotime($flightSegment['ArrivalDateTime'])-strtotime($flightSegment['DepartureDateTime']))/60);
                        $hours = intval($dateDiff/60);
                        $minutes = $dateDiff%60;
                        $flightSegmentInfo = [
                            'originDestinationPlacement'     =>  $originDestinationPlacement,
                            'departureDateTime'     => $flightSegment['DepartureDateTime'],
                            'arrivalDateTime'       => $flightSegment['ArrivalDateTime'],
                            'flightNumber'          => $flightSegment['FlightNumber'],
                            'resBookDesigCode'      => $flightSegment['ResBookDesigCode'],
                            'departureAirportName'  => $flightSegment->DepartureAirport,
                            'arrivalAirportName'    => $flightSegment->ArrivalAirport,
                            'equipment'             => $flightSegment->Equipment[0],
                            'journeyDuration'       => $hours ." hr(s) ".$minutes." min(s)",
                            'journeyTotalDuration'  => $flightSegment->TPA_Extensions->JourneyTotalDuration,
                            'cabin'                 => $flightSegment->TPA_Extensions->CabinType->attributes()->Cabin[0],
                            'operatingAirlineName'  => $flightSegment->OperatingAirline[0],
                            'marketingAirline'      => $flightSegment->MarketingAirline[0],
                            'operatingAirlineCode'  => $flightSegment->OperatingAirline->attributes()->Code[0],
                            'marketingAirlineCode'  => $flightSegment->MarketingAirline->attributes()->Code[0],
                            'departureAirportCode'  => $itinerary->AirItineraryPricingInfo->FareInfos->FareInfo[$fareInfoCount]->DepartureAirport->attributes()->LocationCode[0],
                            'arrivalAirportCode'    => $itinerary->AirItineraryPricingInfo->FareInfos->FareInfo[$fareInfoCount]->ArrivalAirport->attributes()->LocationCode[0],
                            'filingAirlineCode'    =>  $itinerary->AirItineraryPricingInfo->FareInfos->FareInfo[$fareInfoCount]->FilingAirline->attributes()->Code[0]
                        ];
                        $fareInfoCount = $fareInfoCount +1;
                        array_push($originDestinationInfo , $flightSegmentInfo);
                    }

                    $originDestinationPlacement = $originDestinationPlacement + 1;
                }
            }
            else{
                $originDestination = $originDestinations;
                $originDestinationsCount = 1;
                if(isset($originDestination->FlightSegment[0])){
                    $stops = count($originDestination->FlightSegment) - 1;
                    $cabinType = $originDestination->FlightSegment[0]->TPA_Extensions->CabinType->attributes()->Cabin[0];
                    $displayAirline = $originDestination->FlightSegment[0]->MarketingAirline->attributes()->Code[0];
                    foreach($originDestination['FlightSegment'] as $j => $flightSegment){
                        $dateDiff = intval((strtotime($flightSegment['ArrivalDateTime'])-strtotime($flightSegment['DepartureDateTime']))/60);
                        $hours = intval($dateDiff/60);
                        $minutes = $dateDiff%60;


                        $flightSegmentInfo = [
                            'originDestinationPlacement'     =>  1,
                            'departureDateTime'     => $flightSegment['DepartureDateTime'],
                            'arrivalDateTime'       => $flightSegment['ArrivalDateTime'],
                            'flightNumber'          => $flightSegment['FlightNumber'],
                            'resBookDesigCode'      => $flightSegment['ResBookDesigCode'],
                            'departureAirportName'  => $flightSegment->DepartureAirport,
                            'arrivalAirportName'    => $flightSegment->ArrivalAirport,
                            'equipment'             => $flightSegment->Equipment[0],
                            'journeyDuration'       => $hours ." hr(s) ".$minutes." min(s)",
                            'journeyTotalDuration'  => $flightSegment->TPA_Extensions->JourneyTotalDuration,
                            'cabin'                 => $flightSegment->TPA_Extensions->CabinType->attributes()->Cabin[0],
                            'operatingAirlineName'  => $flightSegment->OperatingAirline[0],
                            'marketingAirline'      => $flightSegment->MarketingAirline[0],
                            'operatingAirlineCode'  => $flightSegment->OperatingAirline->attributes()->Code[0],
                            'marketingAirlineCode'  => $flightSegment->MarketingAirline->attributes()->Code[0],
                            'departureAirportCode'  => $itinerary->AirItineraryPricingInfo->FareInfos->FareInfo[$fareInfoCount]->DepartureAirport->attributes()->LocationCode[0],
                            'arrivalAirportCode'    => $itinerary->AirItineraryPricingInfo->FareInfos->FareInfo[$fareInfoCount]->ArrivalAirport->attributes()->LocationCode[0],
                            'filingAirlineCode'    =>  $itinerary->AirItineraryPricingInfo->FareInfos->FareInfo[$fareInfoCount]->FilingAirline->attributes()->Code[0]
                        ];
                        $fareInfoCount = $fareInfoCount +1;
                        array_push($originDestinationInfo , $flightSegmentInfo);
                    }
                }
                else{
                    $flightSegment = $originDestination->FlightSegment;
                    $stops = 0;
                    $cabinType = $originDestination->FlightSegment->TPA_Extensions->CabinType->attributes()->Cabin[0];
                    $displayAirline = $originDestination->FlightSegment->MarketingAirline->attributes()->Code[0];
                    $dateDiff = intval((strtotime($flightSegment['ArrivalDateTime'])-strtotime($flightSegment['DepartureDateTime']))/60);
                    $hours = intval($dateDiff/60);
                    $minutes = $dateDiff%60;

                    $flightSegmentInfo = [
                        'originDestinationPlacement'     =>  1,
                        'departureDateTime'     => $flightSegment['DepartureDateTime'],
                        'arrivalDateTime'       => $flightSegment['ArrivalDateTime'],
                        'flightNumber'          => $flightSegment['FlightNumber'],
                        'resBookDesigCode'      => $flightSegment['ResBookDesigCode'],
                        'departureAirportName'  => $flightSegment->DepartureAirport,
                        'arrivalAirportName'    => $flightSegment->ArrivalAirport,
                        'equipment'             => $flightSegment->Equipment[0],
                        'journeyDuration'       => $hours ." hr(s) ".$minutes." min(s)",
                        'journeyTotalDuration'  => $flightSegment->TPA_Extensions->JourneyTotalDuration,
                        'cabin'                 => $flightSegment->TPA_Extensions->CabinType->attributes()->Cabin[0],
                        'operatingAirlineName'  => $flightSegment->OperatingAirline[0],
                        'marketingAirline'      => $flightSegment->MarketingAirline[0],
                        'operatingAirlineCode'  => $flightSegment->OperatingAirline->attributes()->Code[0],
                        'marketingAirlineCode'  => $flightSegment->MarketingAirline->attributes()->Code[0],
                        'departureAirportCode'  => $itinerary->AirItineraryPricingInfo->FareInfos->FareInfo[$fareInfoCount]->DepartureAirport->attributes()->LocationCode[0],
                        'arrivalAirportCode'    => $itinerary->AirItineraryPricingInfo->FareInfos->FareInfo[$fareInfoCount]->ArrivalAirport->attributes()->LocationCode[0],
                        'filingAirlineCode'    =>  $itinerary->AirItineraryPricingInfo->FareInfos->FareInfo[$fareInfoCount]->FilingAirline->attributes()->Code[0]
                    ];
                    $fareInfoCount = $fareInfoCount +1;
                    array_push($originDestinationInfo , $flightSegmentInfo);
                }
            }

            $fareBrakeDowns = $itinerary->AirItineraryPricingInfo->PTC_FareBreakdowns->PTC_FareBreakdown;
            if(isset($fareBrakeDowns[0])){
                foreach($fareBrakeDowns as $serial => $brakeDown){
                    $bags = [];
                    if(isset($brakeDown->PassengerFare->FreeBagAllowance)){
                        $baggageAllowances = $brakeDown->PassengerFare->FreeBagAllowance;
                        if(isset($baggageAllowaces[0])){
                            foreach($baggageAllowances as $b => $baggageAllowance){
                                $baggageAllowanceInfo = array_get($baggageAllowance, 'Weight',array_get($baggageAllowance[''],'Quantity',0));
                                $baggageUnit          = array_get($baggageAllowance,'Unit',array_get($baggageAllowance[''],'Type',0));
                                $bagArray = $baggageAllowanceInfo."-".$baggageUnit;
                                array_push($bags, $bagArray);
                            }
                        }else{
                            $baggageAllowance = $baggageAllowances;
                            $baggageAllowanceInfo = array_get($baggageAllowance, 'Weight',array_get($baggageAllowance,'Quantity',0));
                            $baggageUnit          = array_get($baggageAllowance,'Unit',array_get($baggageAllowance,'Type',0));
                            $bagArray = $baggageAllowanceInfo."-".$baggageUnit;
                            array_push($bags, $bagArray);

                        }
                    }

                    $fareBrakeDownInfo = [
                        'passengerType' => $brakeDown->PassengerTypeQuantity->attributes()->Code[0],
                        'quantity'      => $brakeDown->PassengerTypeQuantity->attributes()->Quantity[0],
                        'price'         => $brakeDown->PassengerFare->TotalFare->attributes()->Amount[0],
                        'freeBagAllowance' => $bags,
                    ];
                    array_push($defaultFareInfo, $fareBrakeDownInfo);
                }
            }
            else{
                $brakeDown = $fareBrakeDowns;
                $fareBrakeDownInfo = [
                    'passengerType' => $brakeDown->PassengerTypeQuantity->attributes()->Code[0],
                    'quantity'      => $brakeDown->PassengerTypeQuantity->attributes()->Quantity[0],
                    'price'         => $brakeDown->PassengerFare->TotalFare->attributes()->Amount[0],
                ];
                array_push($defaultFareInfo, $fareBrakeDownInfo);
            }

            $itineraryDefaultPrice = $itinerary->AirItineraryPricingInfo->ItinTotalFare->TotalFare->attributes()->Amount[0];
            $customerMarkup        = 0;
            $agentMarkup           = 0;
            $adminMarkup           = 0;
            $vat                   = 0;
            $airlineMarkdown       = 0;
            $customerTotal         = 0;
            $agentTotal            = 0;
            $adminTotal            = 0;
            $displayTotal          = 0;


            $agentMarkupInfo    = Markup::where('role_id', 2)->first();
            $customerMarkupInfo = Markup::where('role_id', 3)->first();
            $vatInfo            = Vat::where('id',1)->first();
            $markdownInfo       = Markdown::where('airline_code',$itinerary->AirItineraryPricingInfo->attributes()->ValidatingAirlineCode[0])->first();
            if(!is_null($markdownInfo)){
                $airlineMarkdown = $this->priceTypeCalculator($markdownInfo->type,$markdownInfo->type,$itineraryDefaultPrice);
            }
            $agentMarkup    = $this->priceTypeCalculator($agentMarkupInfo->flight_markup_type,$agentMarkupInfo->flight_markup_type,$itineraryDefaultPrice);
            $customerMarkup = $this->priceTypeCalculator($customerMarkupInfo->flight_markup_type,$customerMarkupInfo->flight_markup_type,$itineraryDefaultPrice);
            $adminMarkup    = 0;
            $vat            = $this->priceTypeCalculator($vatInfo->flight_vat_type,$vatInfo->flight_vat_type,$itineraryDefaultPrice);

            $customerTotal = ($itineraryDefaultPrice + $customerMarkup + $vat) - $airlineMarkdown;
            $agentTotal    = ($itineraryDefaultPrice + $agentMarkup + $vat) - $airlineMarkdown;
            $adminTotal    = ($itineraryDefaultPrice + $adminMarkup + $vat) - $airlineMarkdown;

            if(auth()->guest()){
                $displayTotal = $customerTotal;
            }
            else{
                if(auth()->user()->hasRole('admin')){
                    $displayTotal = $adminTotal;
                }elseif(auth()->user()->hasRole('agent')){
                    $displayTotal = $agentTotal;
                }elseif(auth()->user()->hasRole('customer')){
                    $displayTotal = $customerTotal;
                }
            }

            $itineraryInformation = [
                'directionInd'             => $itinerary->AirItinerary->attributes()->DirectionInd[0],
                'ticketTimeLimit'          => $itinerary->TicketingInfo->attributes()->TicketTimeLimit[0],
                'pricingSource'            => $itinerary->AirItineraryPricingInfo->attributes()->PricingSource[0],
                'validatingAirlineCode'    => $itinerary->AirItineraryPricingInfo->attributes()->ValidatingAirlineCode[0],
                'defaultItineraryPrice'    => $itineraryDefaultPrice,
                'originDestinationsCount'  => $originDestinationsCount,
                'cabinType'                => $cabinType,
                'stops'                    => $stops,
                'displayAirline'           => $displayAirline,
                'adminToCustomerMarkup'    => $customerMarkup,
                'adminToAgentMarkup'       => $agentMarkup,
                'adminToAdminMarkup'       => $adminMarkup,
                'vat'                      => $vat,
                'airlineMarkdown'          => $airlineMarkdown,
                'customerTotal'            => $customerTotal,
                'agentTotal'               => $agentTotal,
                'adminTotal'               => $adminTotal,
                'displayTotal'             => $displayTotal,
                'itineraryPassengerInfo'   => $defaultFareInfo,
                'originDestinations'       => $originDestinationInfo
            ];

            array_push($sortedResponse,$itineraryInformation);
        }

        return $this->lowFarePlusResponsePrettySortFromXML($sortedResponse);
    }

    public function lowFarePlusResponsePrettySortFromXML($response){
        $responseArray = json_decode(json_encode($response,true),true);
        $sortedResponse = [];
        foreach($responseArray as $serial => $itinerary){
            $originDestinationInfo = [];
            foreach($itinerary['originDestinations'] as $i => $originDestination){
                $originDestinationOption = [
                    'originDestinationPlacement'     =>  $originDestination['originDestinationPlacement'],
                    'departureDateTime'     => $originDestination['departureDateTime'][0],
                    'arrivalDateTime'       => $originDestination['arrivalDateTime'][0],
                    'flightNumber'          => $originDestination['flightNumber'][0],
                    'resBookDesigCode'      => $originDestination['resBookDesigCode'][0],
                    'departureAirportName'  => $originDestination['departureAirportName'][0],
                    'arrivalAirportName'    => $originDestination['arrivalAirportName'][0],
                    'equipment'             => array_get($originDestination['equipment'],'0',$originDestination['equipment']['@attributes']['AirEquipType']),
                    'journeyDuration'       => $originDestination['journeyDuration'],
                    'journeyTotalDuration'  => array_get($originDestination['journeyTotalDuration'],0,$originDestination['journeyTotalDuration']['0']),
                    'cabin'                 => $originDestination['cabin'][0],
                    'operatingAirlineName'  => $originDestination['operatingAirlineName'][0],
                    'marketingAirline'      => $originDestination['marketingAirline'][0],
                    'operatingAirlineCode'  => $originDestination['operatingAirlineCode'][0],
                    'marketingAirlineCode'  => $originDestination['marketingAirlineCode'][0],
                    'departureAirportCode'  => $originDestination['departureAirportCode'][0],
                    'arrivalAirportCode'    => $originDestination['arrivalAirportCode'][0],
                    'filingAirlineCode'    =>   $originDestination['filingAirlineCode'][0]
                ];
                 array_push($originDestinationInfo, $originDestinationOption);
            }

            $defaultFareInfo = [];
            foreach($itinerary['itineraryPassengerInfo'] as $j => $fareInfo){
                $fare = [
                    'passengerType'    => $fareInfo['passengerType'][0],
                    'quantity'         => $fareInfo['quantity'][0],
                    'price'            => $fareInfo['price'][0],
                    'freeBagAllowance' => $fareInfo['freeBagAllowance'],
                ];
                array_push($defaultFareInfo,$fare);
            }


            $itineraryInfo = [
                'directionInd'             => $itinerary['directionInd'][0],
                'ticketTimeLimit'          => $itinerary['ticketTimeLimit'][0],
                'pricingSource'            => $itinerary['pricingSource'][0],
                'validatingAirlineCode'    => $itinerary['validatingAirlineCode'][0],
                'defaultItineraryPrice'    => $itinerary['defaultItineraryPrice'][0],
                'originDestinationsCount'  => $itinerary['originDestinationsCount'],
                'cabinType'                => $itinerary['cabinType'][0],
                'stops'                    => $itinerary['stops'],
                'displayAirline'           => $itinerary['displayAirline'][0],
                'adminToCustomerMarkup'    => $itinerary['adminToCustomerMarkup'],
                'adminToAgentMarkup'       => $itinerary['adminToAgentMarkup'],
                'adminToAdminMarkup'       => $itinerary['adminToAdminMarkup'],
                'vat'                      => $itinerary['vat'],
                'airlineMarkdown'          => $itinerary['airlineMarkdown'],
                'customerTotal'            => $itinerary['customerTotal'],
                'agentTotal'               => $itinerary['agentTotal'],
                'adminTotal'               => $itinerary['adminTotal'],
                'displayTotal'             => $itinerary['displayTotal'],
                'itineraryPassengerInfo'   => $defaultFareInfo,
                'originDestinations'       => $originDestinationInfo
            ];
            array_push($sortedResponse,$itineraryInfo);
        }
        return $sortedResponse;
    }

    public function lowFarePlusResponseAvailableAirline($sortedResponseArray){
        $airlines = [];
        foreach($sortedResponseArray as $serial => $response){
            array_push($airlines, $response['displayAirline']);
        }

       return array_values(array_unique($airlines));
    }

    public function lowFarePlusResponseAvailableCabin($sortedResponseArray){
        $cabins = [];
        foreach($sortedResponseArray as $serial => $response){
            array_push($cabins, $response['cabinType']);
        }

        return array_values(array_unique($cabins));
    }

    public function lowFarePlusResponseAvailableStops($sortedResponseArray){
        $stops = [];
        foreach($sortedResponseArray as $serial => $response){
            array_push($stops, $response['stops']);
        }

        return array_values(array_unique($stops));
    }

    public function lowFarePlusResponseAvailablePrice($sortedResponseArray){
        $prices = [];
        foreach($sortedResponseArray as $serial => $response){
            array_push($prices, (round($response['displayTotal']/100)));
        }

        return array_values(array_unique($prices));
    }

    public function airPriceResponseXMLValidator($responseXML){
        $responseData = simplexml_load_string($this->AmadeusConfig->mungXMl($responseXML));
        if(empty($responseData)){
            return 0;
        }else{
            if(isset($responseData->soap_Body->wmAirPriceResponse->OTA_AirPriceRS->Success)){
                return 1;
            }else{
                if(isset($responseData->soap_Body->wmAirPriceResponse->OTA_AirPriceRS->Errors->Error)){
                    $error = $responseData->soap_Body->wmAirPriceResponse->OTA_AirPriceRS->Errors->Error;
                    return [21 , $error];
                }else{
                    return 2;
                }
            }
        }
    }

    public function airPriceResponseSort($responseXML){

        $responseData = json_decode(json_encode(simplexml_load_string($responseXML),true),true);
        $Itinerary = $responseData['soap_Body']['wmAirPriceResponse']['OTA_AirPriceRS']['PricedItineraries']['PricedItinerary'];

        $farePenalties = [];
        foreach($Itinerary['AirItineraryPricingInfo']['FareInfos']['FareInfo'] as $i => $fareInfo){
            $farePenalty = array_get($fareInfo,'RuleInfo',0);
            if($farePenalty != 0){
                $farePenalty = $fareInfo['RuleInfo']['ChargesRules']['VoluntaryChanges']['Penalty']['@attributes']['PenaltyType'];
            }
            array_push($farePenalties,$farePenalty);
        }

        $passengerFareBrakeDown = [];
        if(isset($Itinerary['AirItineraryPricingInfo']['PTC_FareBreakdowns']['PTC_FareBreakdown'][0])){
            foreach($Itinerary['AirItineraryPricingInfo']['PTC_FareBreakdowns']['PTC_FareBreakdown'] as $i => $brakeDown){
                $brakeDownData = [
                    'passengerType'    => $brakeDown['PassengerTypeQuantity']['@attributes']['Code'],
                    'quantity'         => $brakeDown['PassengerTypeQuantity']['@attributes']['Quantity'],
                    'price'            => ($brakeDown['PassengerFare']['TotalFare']['@attributes']['Amount'] * 100),
                    'freeBagAllowance' => '',
                ];
                array_push($passengerFareBrakeDown, $brakeDownData);
            }
        }
        else{
            $brakeDown = $Itinerary['AirItineraryPricingInfo']['PTC_FareBreakdowns']['PTC_FareBreakdown'];
            $brakeDownData = [
                'passengerType'    => $brakeDown['PassengerTypeQuantity']['@attributes']['Code'],
                'quantity'         => $brakeDown['PassengerTypeQuantity']['@attributes']['Quantity'],
                'price'            => ($brakeDown['PassengerFare']['TotalFare']['@attributes']['Amount'] * 100),
                'freeBagAllowance' => '',
            ];
            array_push($passengerFareBrakeDown, $brakeDownData);
        }

        $responseArray = [
            'newTotalPrice' => ($Itinerary['AirItineraryPricingInfo']['ItinTotalFare']['TotalFare']['@attributes']['Amount'] * 100),
            'passengerFareBrakeDown' => $passengerFareBrakeDown,
            'fareRules' => $farePenalties
        ];

        return $responseArray;

    }

    public function flightBuildResponseValidator($responseArray){
        if(empty($responseArray)){
            return 0;
        }
        else{
            if(isset($responseArray['soap_Body']['wmTravelBuildResponse']['OTA_TravelItineraryRS']['Success'])){
                return 1;
            }
            elseif($responseArray['soap_Body']['wmTravelBuildResponse']['OTA_TravelItineraryRS']['Errors']){
                $error = $responseArray['soap_Body']['wmTravelBuildResponse']['OTA_TravelItineraryRS']['Errors']['Error'];
                return [21, $error];
            }
            else{
                return 2;
            }
        }
    }

    public function flightBuildResponseSort($responseArray){
        $flights = [];
        $bagsAllowance = [];
        $passengers = [];
        $pnrData = $responseArray['soap_Body']['wmTravelBuildResponse']['OTA_TravelItineraryRS']['TravelItinerary'];
        $allFlights = $pnrData['ItineraryInfo']['ReservationItems']['Item'];
        if(isset($allFlights[0])){
            foreach($allFlights as $i => $allFlight){
                array_push($flights, $allFlight);
            }
        }
        else{
            array_push($flights, $allFlights);
        }

        $allBags = $pnrData['ItineraryInfo']['ReservationItems']['ItemPricing']['AirFareInfo']['PTC_FareBreakdowns']['PTC_FareBreakdown'];

        if(isset($allBags[0])){
            foreach($allBags as $j => $allBag){
                array_push($bagsAllowance, $allBag);
            }
        }
        else{
            array_push($bagsAllowance, $allBags);
        }

        $allPassengers = $pnrData['CustomerInfos']['CustomerInfo'];
        if(isset($allPassengers[0])){
            foreach($allPassengers as $k => $allPassenger){
                array_push($passengers,$allPassenger);
            }
        }
        else{
            array_push($passengers,$allPassengers);
        }


        return [
            'pnr'           => $pnrData['ItineraryRef']['@attributes']['ID'],
            'flights'       => $flights,
            'bagsAllowance' => $bagsAllowance,
            'passengers'    => $passengers
        ];
    }

    public function hotelAvailResponseValidator($responseArray){
        if(empty($responseArray)){
            return 0;
        }else{
            if(isset($responseArray['soap_Body']['wmHotelAvailResponse']['OTA_HotelAvailRS']['Success'])){
                return 1;
            }elseif(isset($responseArray['soap_Body']['wmHotelAvailResponse']['OTA_HotelAvailRS']['Errors']['Error'])){
                $error = $responseArray['soap_Body']['wmHotelAvailResponse']['OTA_HotelAvailRS']['Errors']['Error'];
                return [
                    2,$error
                ];
            }else{
                return 2;
            }
        }
    }

    public function hotelAvailResponseSort($responseArray){
         $hotels = [];
         $availableHotels = $responseArray['soap_Body']['wmHotelAvailResponse']['OTA_HotelAvailRS']['RoomStays']['RoomStay'];
         if(isset($availableHotels[0])){
             foreach($availableHotels as $serial => $availableHotel){
                 $minimumRate   = $availableHotel['RatePlans']['RatePlan']['AdditionalDetails']['AdditionalDetail'][0]['@attributes']['Amount'];
                 $numberOfUnits = $availableHotel['RoomRates']['RoomRate']['@attributes']['NumberOfUnits'];
                 $guestCounts   = $availableHotel['GuestCounts']['GuestCount']['@attributes']['Count'];
                 $startDate     = $availableHotel['TimeSpan']['@attributes']['Start'];
                 $endDate       = $availableHotel['TimeSpan']['@attributes']['End'];
                 $chainCode     = $availableHotel['BasicPropertyInfo']['@attributes']['ChainCode'];
                 $hotelCode     = $availableHotel['BasicPropertyInfo']['@attributes']['HotelCode'];
                 $hotelCityCode = $availableHotel['BasicPropertyInfo']['@attributes']['HotelCityCode'];
                 $hotelName     = $availableHotel['BasicPropertyInfo']['@attributes']['HotelName'];
                 $hotelContextCode = $availableHotel['BasicPropertyInfo']['@attributes']['HotelCodeContext'];
                 $hotelImage    = $availableHotel['BasicPropertyInfo']['VendorMessages']['VendorMessage'][0]['SubSection']['Paragraph']['URL'];
                 if(isset($availableHotel['BasicPropertyInfo']['Award'])){
                     $star_rating_size = count($availableHotel['BasicPropertyInfo']['Award']);
                     if($star_rating_size == 1){
                         if($availableHotel['BasicPropertyInfo']['Award']['@attributes']['Provider'] == 'Local Star Rating'){
                             $hotelStarRating = $availableHotel['BasicPropertyInfo']['Award']['@attributes']['Rating'];
                         }else{
                             $hotelStarRating = 0;
                         }
                     }elseif($star_rating_size > 1){
                         for($r = 0; $r < $star_rating_size; $r++){
                             if($availableHotel['BasicPropertyInfo']['Award'][$r]['@attributes']['Provider'] == 'Local Star Rating'){
                                 $hotelStarRating = $availableHotel['BasicPropertyInfo']['Award'][$r]['@attributes']['Rating'];
                             }else{
                                 $hotelStarRating = 0;
                             }
                         }
                     }
                 }
                 else{
                     $hotelStarRating = 0;
                 }

                 $hotelChainName = '';
                 $hotelContactNumber = '';
                 if(isset($availableHotel['BasicPropertyInfo']['@attributes']['ChainName'])){
                     $hotelContactNumber =  $availableHotel['BasicPropertyInfo']['@attributes']['ChainName'];
                 }
                 if(isset($availableHotel['BasicPropertyInfo']['ContactNumbers'])){
                     if(is_array($availableHotel['BasicPropertyInfo']['ContactNumbers']['ContactNumber'])){
                         $hotelContactNumber = $availableHotel['BasicPropertyInfo']['ContactNumbers']['ContactNumber'][0]['@attributes']['PhoneNumber'];
                     }else{
                         $hotelContactNumber = $availableHotel['BasicPropertyInfo']['ContactNumbers']['ContactNumber']['@attributes']['PhoneNumber'];
                     }
                 }
                 if(isset($availableHotel['BasicPropertyInfo']['Address'])){
                     $hotelAddress = $availableHotel['BasicPropertyInfo']['Address']['AddressLine'];
                     if(is_array($hotelAddress)){
                         $hotelAds = '';
                         foreach($hotelAddress as $i => $hotelAddresss){
                             $hotelAds = $hotelAds.', '.$hotelAddresss;
                         }
                         $hotelAddress = $hotelAds;
                     }
                     if(isset($availableHotel['BasicPropertyInfo']['Address']['CityName'])){
                         $hotelCityName = $availableHotel['BasicPropertyInfo']['Address']['CityName'];
                     }else{
                         $hotelCityName = '';
                     }
                     $hotelCountryCode = $availableHotel['BasicPropertyInfo']['Address']['CountryName']['@attributes']['Code'];
                 }
                 else{
                     $hotelAddress = 'no address available';
                     $hotelCityName = '';
                     $hotelCountryCode = '';
                 }

                 $hotelInformation = $availableHotel['BasicPropertyInfo']['VendorMessages']['VendorMessage'][1]['SubSection']['Paragraph']['Text'];
                 if(isset($availableHotel['RoomTypes']['RoomType']['Amenities']['Amenity'])){
                     $hotelAmenities   = $availableHotel['RoomTypes']['RoomType']['Amenities']['Amenity'];
                 }else{
                     $hotelAmenities   = '';
                 }

                 $hotel = [
                     'minimumRate'      => $minimumRate,
                     'numberOfUnits'    => $numberOfUnits,
                     'guestCounts'      => $guestCounts,
                     'startDate'        => $startDate,
                     'endDate'          => $endDate,
                     'chainCode'        => $chainCode,
                     'hotelCode'        => $hotelCode,
                     'hotelCityCode'    => $hotelCityCode,
                     'hotelName'        => $hotelName,
                     'hotelContextCode' => $hotelContextCode,
                     'hotelImage'       => $hotelImage,
                     'hotelStarRating'  => $hotelStarRating,
                     'hotelChainName'   => $hotelChainName,
                     'hotelAddress'     => $hotelAddress,
                     'hotelInformation' => $hotelInformation,
                     'hotelAmenities'   => $hotelAmenities,
                     'hotelCountryCode' => $hotelCountryCode,
                     'hotelCityName'    => $hotelCityName,
                     'hotelContactNumber' => $hotelContactNumber
                 ];
                 array_push($hotels, $hotel);
             }
         }
         else{
             $availableHotel = $availableHotels;
             $minimumRate   = $availableHotel['RatePlans']['RatePlan']['AdditionalDetails']['AdditionalDetail'][0]['@attributes']['Amount'];
             $numberOfUnits = $availableHotel['RoomRates']['RoomRate']['@attributes']['NumberOfUnits'];
             $guestCounts   = $availableHotel['GuestCounts']['GuestCount']['@attributes']['Count'];
             $startDate     = $availableHotel['TimeSpan']['@attributes']['Start'];
             $endDate       = $availableHotel['TimeSpan']['@attributes']['End'];
             $chainCode     = $availableHotel['BasicPropertyInfo']['@attributes']['ChainCode'];
             $hotelCode     = $availableHotel['BasicPropertyInfo']['@attributes']['HotelCode'];
             $hotelCityCode = $availableHotel['BasicPropertyInfo']['@attributes']['HotelCityCode'];
             $hotelName     = $availableHotel['BasicPropertyInfo']['@attributes']['HotelName'];
             $hotelContextCode = $availableHotel['BasicPropertyInfo']['@attributes']['HotelCodeContext'];
             $hotelImage    = $availableHotel['BasicPropertyInfo']['VendorMessages']['VendorMessage'][0]['SubSection']['Paragraph']['URL'];
             if(isset($availableHotel['BasicPropertyInfo']['Award'])){
                 $star_rating_size = count($availableHotel['BasicPropertyInfo']['Award']);
                 if($star_rating_size == 1){
                     if($availableHotel['BasicPropertyInfo']['Award']['@attributes']['Provider'] == 'Local Star Rating'){
                         $hotelStarRating = $availableHotel['BasicPropertyInfo']['Award']['@attributes']['Rating'];
                     }else{
                         $hotelStarRating = 0;
                     }
                 }elseif($star_rating_size > 1){
                     for($r = 0; $r < $star_rating_size; $r++){
                         if($availableHotel['BasicPropertyInfo']['Award'][$r]['@attributes']['Provider'] == 'Local Star Rating'){
                             $hotelStarRating = $availableHotel['BasicPropertyInfo']['Award'][$r]['@attributes']['Rating'];
                         }else{
                             $hotelStarRating = 0;
                         }
                     }
                 }
             }
             else{
                 $hotelStarRating = 0;
             }

             $hotelChainName = '';
             $hotelContactNumber = '';
             if(isset($availableHotel['BasicPropertyInfo']['@attributes']['ChainName'])){
                 $hotelChainName = $availableHotel['BasicPropertyInfo']['@attributes']['ChainName'];
             }
             if(isset($availableHotel['BasicPropertyInfo']['ContactNumbers'])){
                 if(is_array($availableHotel['BasicPropertyInfo']['ContactNumbers']['ContactNumber'])){
                     $hotelContactNumber = $availableHotel['BasicPropertyInfo']['ContactNumbers']['ContactNumber'][0]['@attributes']['PhoneNumber'];
                 }else{
                     $hotelContactNumber = $availableHotel['BasicPropertyInfo']['ContactNumbers']['ContactNumber']['@attributes']['PhoneNumber'];
                 }
             }

             $hotelAddress = 'no address available';
             $hotelCityName = '';
             $hotelCountryCode = '';

             if(isset($availableHotel['BasicPropertyInfo']['Address'])){
                 $hotelAddress = $availableHotel['BasicPropertyInfo']['Address']['AddressLine'];
                 if(is_array($hotelAddress)){
                     $hotelAds = '';
                     foreach($hotelAddress as $i => $hotelAddresss){
                         $hotelAds = $hotelAds.', '.$hotelAddresss;
                     }
                     $hotelAddress = $hotelAds;
                 }
                 if(isset($availableHotel['BasicPropertyInfo']['Address']['CityName'])){
                     $hotelCityName = $availableHotel['BasicPropertyInfo']['Address']['CityName'];
                 }else{
                     $room_details['CityName'] = '';
                 }
                 $hotelCountryCode = $availableHotel['BasicPropertyInfo']['Address']['CountryName']['@attributes']['Code'];
             }


             $hotelInformation = $availableHotel['BasicPropertyInfo']['VendorMessages']['VendorMessage'][1]['SubSection']['Paragraph']['Text'];
             if(isset($availableHotel['RoomTypes']['RoomType']['Amenities']['Amenity'])){
                 $hotelAmenities   = $availableHotel['RoomTypes']['RoomType']['Amenities']['Amenity'];
             }else{
                 $hotelAmenities   = '';
             }
             $hotel = [
                 'minimumRate'      => $minimumRate,
                 'numberOfUnits'    => $numberOfUnits,
                 'guestCounts'      => $guestCounts,
                 'startDate'        => $startDate,
                 'endDate'          => $endDate,
                 'chainCode'        => $chainCode,
                 'hotelCode'        => $hotelCode,
                 'hotelCityCode'    => $hotelCityCode,
                 'hotelName'        => $hotelName,
                 'hotelContextCode' => $hotelContextCode,
                 'hotelImage'       => $hotelImage,
                 'hotelStarRating'  => $hotelStarRating,
                 'hotelChainName'   => $hotelChainName,
                 'hotelAddress'     => $hotelAddress,
                 'hotelInformation' => $hotelInformation,
                 'hotelAmenities'   => $hotelAmenities,
                 'hotelCountryCode' => $hotelCountryCode,
                 'hotelCityName'    => $hotelCityName,
                 'hotelContactNumber' => $hotelContactNumber
             ];
             array_push($hotels, $hotel);
         }
         return $hotels;
    }

    public function hotelAvailRoomResponseSort($responseArray){

        $availableHotel = $responseArray['soap_Body']['wmHotelAvailResponse']['OTA_HotelAvailRS']['RoomStays']['RoomStay'];
        $minimumRate   = 0;
        $numberOfUnits = count($availableHotel['RoomRates']['RoomRate']);
        $guestCounts   = $availableHotel['GuestCounts']['GuestCount']['@attributes']['Count'];
        $startDate     = $availableHotel['TimeSpan']['@attributes']['Start'];
        $endDate       = $availableHotel['TimeSpan']['@attributes']['End'];
        $chainCode     = $availableHotel['BasicPropertyInfo']['@attributes']['ChainCode'];
        $hotelCode     = $availableHotel['BasicPropertyInfo']['@attributes']['HotelCode'];
        $hotelCityCode = $availableHotel['BasicPropertyInfo']['@attributes']['HotelCityCode'];
        $hotelName     = $availableHotel['BasicPropertyInfo']['@attributes']['HotelName'];
        $hotelContextCode = $availableHotel['BasicPropertyInfo']['@attributes']['HotelCodeContext'];
        $hotelImage    = $availableHotel['BasicPropertyInfo']['VendorMessages']['VendorMessage'][0]['SubSection']['Paragraph']['URL'];
        if(isset($availableHotel['BasicPropertyInfo']['Award'])){
            $star_rating_size = count($availableHotel['BasicPropertyInfo']['Award']);
            if($star_rating_size == 1){
                if($availableHotel['BasicPropertyInfo']['Award']['@attributes']['Provider'] == 'Local Star Rating'){
                    $hotelStarRating = $availableHotel['BasicPropertyInfo']['Award']['@attributes']['Rating'];
                }else{
                    $hotelStarRating = 0;
                }
            }elseif($star_rating_size > 1){
                for($r = 0; $r < $star_rating_size; $r++){
                    if($availableHotel['BasicPropertyInfo']['Award'][$r]['@attributes']['Provider'] == 'Local Star Rating'){
                        $hotelStarRating = $availableHotel['BasicPropertyInfo']['Award'][$r]['@attributes']['Rating'];
                    }else{
                        $hotelStarRating = 0;
                    }
                }
            }
        }
        else{
            $hotelStarRating = 0;
        }

        $hotelChainName = '';
        $hotelContactNumber = '';
        $hotelAddress = 'no address available';
        $hotelCityName = '';
        $hotelCountryCode = '';
        $hotelAmenities = '';
        $daysCount = 0;

        if(isset($availableHotel['BasicPropertyInfo']['@attributes']['ChainName'])){
            $hotelChainName =  $availableHotel['BasicPropertyInfo']['@attributes']['ChainName'];
        }
        if(isset($availableHotel['BasicPropertyInfo']['ContactNumbers'])){
            if(is_array($availableHotel['BasicPropertyInfo']['ContactNumbers']['ContactNumber'])){
                $hotelContactNumber = $availableHotel['BasicPropertyInfo']['ContactNumbers']['ContactNumber'][0]['@attributes']['PhoneNumber'];
            }else{
                $hotelContactNumber = $availableHotel['BasicPropertyInfo']['ContactNumbers']['ContactNumber']['@attributes']['PhoneNumber'];
            }
        }
        if(isset($availableHotel['BasicPropertyInfo']['Address'])){
            $hotelAddress = $availableHotel['BasicPropertyInfo']['Address']['AddressLine'];
            if(is_array($hotelAddress)){
                $hotelAds = '';
                foreach($hotelAddress as $i => $hotelAddresss){
                    $hotelAds = $hotelAds.', '.$hotelAddresss;
                }
                $hotelAddress = $hotelAds;
            }
            if(isset($availableHotel['BasicPropertyInfo']['Address']['CityName'])){
                $hotelCityName = $availableHotel['BasicPropertyInfo']['Address']['CityName'];
            }else{
                $hotelCityName = '';
            }
            $hotelCountryCode = $availableHotel['BasicPropertyInfo']['Address']['CountryName']['@attributes']['Code'];
        }


        if(isset($availableHotel['RoomTypes']['RoomType']['Amenities']['Amenity'])){
            $hotelAmenities   = $availableHotel['RoomTypes']['RoomType']['Amenities']['Amenity'];
        }
        else{
            if(isset($availableHotel['BasicPropertyInfo']['HotelAmenity'])){
              $hotelAmenities = $availableHotel['BasicPropertyInfo']['HotelAmenity'];
            }
        }

        $hotelInformation = $availableHotel['BasicPropertyInfo']['VendorMessages']['VendorMessage'][2]['SubSection'];
        $hotelMainText = '';

        foreach($hotelInformation as $serial => $info){
            if(array_get($info['@attributes'],'SubTitle','') == "HotelMainText"){
                $data = $info['Paragraph']['Text'];
                if(is_array($data)){
                    foreach($data as $i => $datum){
                        $hotelMainText = $hotelMainText.','.$datum;
                    }
                }else{
                    $hotelMainText = $data;
                }
            }
        }

        $availableRooms = [];
        $hotelImages = [];

        $roomRates = $availableHotel['RoomRates']['RoomRate'];
        $ratePlans = $availableHotel['RatePlans']['RatePlan'];

        if(isset($roomRates[0])){
            foreach($roomRates as $serial => $roomRate){
                $bookingCode = $ratePlans[$serial]['@attributes']['BookingCode'];
                $ratePlanCode = $ratePlans[$serial]['@attributes']['RatePlanCode'];
                if(isset($ratePlans[$serial]['Guarantee'])){
                    $guarantee    = array_get($ratePlans[$serial]['Guarantee']['@attributes'],'GuaranteeType',array_get($ratePlans[$serial]['Guarantee']['@attributes'],'HoldTime',''));
                }else{
                    $guarantee = "None";
                }
                $roomDetails = $ratePlans[$serial]['AdditionalDetails']['AdditionalDetail'];
                $roomCategory = 'Not Set';
                $numOfBeds = 'Not Set';
                $bedType = 'Not Set';
                foreach($roomDetails as $i => $roomDetail){
                    if(array_get($roomDetail['@attributes'],'Type','') == "Category"){
                        $roomCategory = $roomDetail['DetailDescription']['@attributes']['Name'];
                    }
                    if(array_get($roomDetail['@attributes'],'Type','') == "NumberOfBeds"){
                        $numOfBeds = $roomDetail['DetailDescription']['@attributes']['Name'];
                    }
                    if(array_get($roomDetail['@attributes'],'Type','') == "BedType"){
                        $bedType = $roomDetail['DetailDescription']['@attributes']['Name'];
                    }
                }
                $roomPrice = '';

                if(isset($roomRate['Rates']['Rate'][0])){
                    if(isset($roomRate['Rates']['Rate'][0]['Total']['@attributes']['AmountAfterTax'])){
                        $roomPrice = $roomRate['Rates']['Rate'][0]['Total']['@attributes']['AmountAfterTax'];
                    }else{
                        $roomPrice = $roomRate['Rates']['Rate'][0]['Total']['@attributes']['AmountBeforeTax'];
                    }

                }
                else{
                    if(isset($roomRate['Rates']['Rate']['Total']['@attributes']['AmountAfterTax'])){
                        $roomPrice = $roomRate['Rates']['Rate']['Total']['@attributes']['AmountAfterTax'];
                    }else{
                        $roomPrice = $roomRate['Rates']['Rate']['Total']['@attributes']['AmountBeforeTax'];
                    }
                }


                $roomDescriptions = $roomDetails[0]['DetailDescription']['Text'];

                if(is_array($roomDescriptions)){
                    $roomDescription = '';
                    foreach($roomDescriptions as $j => $roomDesc){
                        $roomDescription = $roomDescription.','.$roomDesc;
                    }
                }
                else{
                    $roomDescription = $roomDescriptions;
                }

                $roomInfo = [
                    'bookingCode' => $bookingCode,
                    'ratePlanCode' => $ratePlanCode,
                    'guarantee'    => $guarantee,
                    'roomCategory' => $roomCategory,
                    'numOfBed'    => $numOfBeds,
                    'bedType'          => $bedType,
                    'roomPrice'        => $roomPrice,
                    'roomDescription'  => $roomDescription,
                ];
                array_push($availableRooms,$roomInfo);
            }
        }
        else{
            $roomRate = $roomRates;
            $bookingCode = $ratePlans['@attributes']['BookingCode'];
            $ratePlanCode = $ratePlans['@attributes']['RatePlanCode'];
            if(isset($ratePlans[$serial]['Guarantee'])){
                $guarantee    = array_get($ratePlans['Guarantee']['@attributes'],'GuaranteeType',array_get($ratePlans['Guarantee']['@attributes'],'HoldTime',''));
            }else{
                $guarantee = "None";
            }
            $roomDetails = $ratePlans['AdditionalDetails']['AdditionalDetail'];
            $roomCategory = 'Not Set';
            $numOfBeds = 'Not Set';
            $bedType = 'Not Set';
            foreach($roomDetails as $i => $roomDetail){
                if(array_get($roomDetail['@attributes'],'Type','') == "Category"){
                    $roomCategory = $roomDetail['DetailDescription']['@attributes']['Name'];
                }
                if(array_get($roomDetail['@attributes'],'Type','') == "NumberOfBeds"){
                    $numOfBeds = $roomDetail['DetailDescription']['@attributes']['Name'];
                }
                if(array_get($roomDetail['@attributes'],'Type','') == "BedType"){
                    $bedType = $roomDetail['DetailDescription']['@attributes']['Name'];
                }
            }
            $roomPrice = '';
            if(isset($roomRate['Rates']['Rate'][0])){
                if(isset($roomRate['Rates']['Rate'][0]['Total']['@attributes']['AmountAfterTax'])){
                    $roomPrice = $roomRate['Rates']['Rate'][0]['Total']['@attributes']['AmountAfterTax'];
                }
                else{
                    $roomPrice = $roomRate['Rates']['Rate'][0]['Total']['@attributes']['AmountBeforeTax'];
                }
            }
            else{
                if(isset($roomRate['Rates']['Rate']['Total']['@attributes']['AmountAfterTax'])){
                    $roomPrice = $roomRate['Rates']['Rate']['Total']['@attributes']['AmountAfterTax'];
                }
                else{
                    $roomPrice = $roomRate['Rates']['Rate']['Total']['@attributes']['AmountBeforeTax'];
                }

            }


            $roomDescriptions = $roomDetails[0]['DetailDescription']['Text'];

            if(is_array($roomDescriptions)){
                $roomDescription = '';
                foreach($roomDescriptions as $j => $roomDesc){
                    $roomDescription = $roomDescription.','.$roomDesc;
                }
            }
            else{
                $roomDescription = $roomDescriptions;
            }
            $roomInfo = [
                'bookingCode' => $bookingCode,
                'ratePlanCode' => $ratePlanCode,
                'guarantee'    => $guarantee,
                'roomCategory' => $roomCategory,
                'numOfBed'    => $numOfBeds,
                'bedType'      => $bedType,
                'roomPrice'    => $roomPrice,
                'roomDescription' => $roomDescription
            ];
            array_push($availableRooms,$roomInfo);
        }

        if(isset($availableHotel['BasicPropertyInfo']['VendorMessages']['VendorMessage'][1]['SubSection']['Paragraph'])){
            $hotelImageHolder = $availableHotel['BasicPropertyInfo']['VendorMessages']['VendorMessage'][1]['SubSection']['Paragraph'];
            if($hotelImageHolder[0]){
                foreach($hotelImageHolder as $serial => $hotelImageNew){
                    array_push($hotelImages,[
                        'title' => $hotelImageNew['@attributes']['Name'],
                        'url' => $hotelImageNew['URL'],
                    ]);
                }
            }
            else{
                array_push($hotelImages,[
                    'title' => $hotelImageHolder['@attributes']['Name'],
                    'url' => $hotelImageHolder['URL'],
                ]);
            }
        }




        return [
            'minimumRate'        => $minimumRate,
            'numberOfUnits'      => $numberOfUnits,
            'guestCounts'        => $guestCounts,
            'startDate'          => $startDate,
            'endDate'            => $endDate,
            'chainCode'          => $chainCode,
            'hotelCode'          => $hotelCode,
            'hotelCityCode'      => $hotelCityCode,
            'hotelName'          => $hotelName,
            'hotelContextCode'   => $hotelContextCode,
            'hotelImage'         => $hotelImage,
            'hotelStarRating'    => $hotelStarRating,
            'hotelChainName'     => $hotelChainName,
            'hotelAddress'       => $hotelAddress,
            'hotelInformation'   => $hotelMainText,
            'hotelAmenities'     => $hotelAmenities,
            'hotelCountryCode'   => $hotelCountryCode,
            'hotelCityName'      => $hotelCityName,
            'hotelContactNumber' => $hotelContactNumber,
            'availableRooms'     => $availableRooms,
            'hotelImages'        => $hotelImages
        ];
    }

    public function cancelPNRResponseValidator($responseArray){
        if(empty($responseArray)){
            return 0;
        }else{
            $cancelResponse = $responseArray['soap_Body']['wmPNRCancelResponse'];
            if(isset($cancelResponse['OTA_CancelRS']['Errors'])){
                $error = $cancelResponse['OTA_CancelRS']['Errors']['Error'];
                return [
                    2, $error
                ];
            }elseif(empty($cancelResponse)){
                return 21;
            }elseif(isset($cancelResponse['OTA_CancelRS']['Success'])){
                return 1;
            }else{
                return 2;
            }
        }
    }

    public function issueTicketResponseValidator($responseArray){
        if(empty($responseArray)){
            return 0;
        }else{
            if(isset($responseArray['soap_Body']['wmIssueTicketResponse']['TT_IssueTicketRS']['Errors']['Error'])){
                $error = $responseArray['soap_Body']['wmIssueTicketResponse']['TT_IssueTicketRS']['Errors']['Error'];
                return [2,$error];
            }elseif(empty($responseArray['soap_Body']['wmIssueTicketResponse'])){
                return 21;
            }elseif(isset($responseArray['soap_Body']['wmIssueTicketResponse']['TT_IssueTicketRS']['TicketingControl'])){
                if($responseArray['soap_Body']['wmIssueTicketResponse']['TT_IssueTicketRS']['TicketingControl']['@attributes']['Type'] == "OK"){
                    return 1;
                }else{
                    return 11;
                }
            }else{
                return 2;
            }
        }
    }

    public function hotelTravelBuildResponseValidator($responseArray){
        if(empty($responseArray)){
            return 0;
        }else{
            if(isset($responseArray['soap_Body']['wmTravelBuildResponse']['OTA_TravelItineraryRS']['Success'])){
                return 1;
            }elseif(isset($responseArray['soap_Body']['wmTravelBuildResponse']['OTA_TravelItineraryRS']['Errors']['Error'])){
                $error = $responseArray['soap_Body']['wmTravelBuildResponse']['OTA_TravelItineraryRS']['Errors']['Error'];
                return [
                    2,
                    $error
                ];
            }else{
                return 2;
            }
        }
    }


}