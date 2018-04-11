<?php
/**
 * Created by PhpStorm.
 * User: UniQue
 * Date: 4/11/2018
 * Time: 1:24 PM
 */

namespace App\Services;


class AmadeusHelper
{

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

    public function lowFarePlusResponseSort($responseArray){

        $sortedResponse = [];
        $originDestinations = [];

        $itineraries = $responseArray['soap_Body']['wmLowFarePlusResponse']['OTA_AirLowFareSearchPlusRS']['PricedItineraries']['PricedItinerary'];

        $sortedResponse = [
            'directionInd' => '',
            'ticketTimeLimit' => '',
            'pricingSource' => '',
            'validatingAirlineCode' => '',
            'defaultItineraryPrice' => '',
            'stops' => '',
            'displayAirline' => '',
            'adminToCustomerMarkup' => '',
            'adminToAgentMarkup' => '',
            'adminToAdminMarkup' => '',
            'vat' => '',
            'airlineMarkdown' => '',
            'customerTotal'   => '',
            'agentTotalPrice' => '',
            'adminTotalPrice' => ''

        ];
        array_push($sortedResponse,$originDestinations);
        return $sortedResponse;

    }

}