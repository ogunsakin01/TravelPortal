<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Services\AmadeusConfig;
use App\Services\AmadeusRequestXML;
use App\Services\AmadeusHelper;
use App\Voucher;
use App\Profile;
use App\FlightBooking;
use App\Markup;
use App\Markdown;
use App\Vat;

class FlightApiController extends Controller
{

    private $AmadeusConfig;

    private $AmadeusRequestXML;

    private $AmadeusHelper;

    public function __construct(){
        $this->AmadeusConfig     = new AmadeusConfig();
        $this->AmadeusRequestXML = new AmadeusRequestXML();
        $this->AmadeusHelper     = new AmadeusHelper();
    }

    public function oneWaySearchV1(Request $data){

        $requestXML = $this->AmadeusRequestXML->lowFarePlusRequestBodyXML($data);
        $this->AmadeusConfig->createXMlFile($requestXML,'LowFarePlusOneWayRQ.XML');
        $search = $this->AmadeusConfig->callAmadeus($this->AmadeusConfig->lowFareRequestHeader($requestXML),$requestXML,$this->AmadeusConfig->lowFarePlusRequestWebServiceUrl);
        $this->AmadeusConfig->createXMlFile($search,'LowFarePlusOneWayRS.XML');

        $responseXml   = $this->AmadeusConfig->mungXML($search);
        $xmlValidatorResponse = $this->AmadeusHelper->lowFarePlusResponseXMLValidator($responseXml);

        if($xmlValidatorResponse === 1){

            $sortedXMLResponse = $this->AmadeusHelper->lowFarePlusResponseSortFromXML($responseXml);

            $searchParam    = [
                'flight_search' => [
                    0 => [
                        'departure_city'   => $data->departure_city,
                        'destination_city' => $data->destination_city,
                        'departure_date'   => $data->departure_date,
                    ]
                ],
                'no_of_adult'  => $data->no_of_adult,
                'no_of_infant' => $data->no_of_infant,
                'no_of_child'  => $data->no_of_child
            ];

            session()->put('flightSearchParam',$searchParam);
            session()->put('availableItineraries',$sortedXMLResponse);

            $returnedResponse = [
                'flightSearchParam'    => $searchParam,
                'availableItineraries' => $sortedXMLResponse
            ];

            return response()->json(["type" => "error","message" => $returnedResponse], 200);

        }
        elseif($xmlValidatorResponse == 2){
            return response()->json(["type" => "error","message" => "No available itineraries for the search option"] ,200);
        }
        elseif(is_array($xmlValidatorResponse)){
            return response()->json(["type" => "error","message" => $xmlValidatorResponse], 200);
        }
        elseif($xmlValidatorResponse == 0){
            return response()->json(["type" => "error","message" => "Connection error"] ,200);
        }


    }

    public function roundTripSearchV1(Request $data){

        $requestXML = $this->AmadeusRequestXML->lowFarePlusRequestBodyXML($data);
        $this->AmadeusConfig->createXMlFile($requestXML,'LowFarePlusRoundTripRQ.XML');
        $search = $this->AmadeusConfig->callAmadeus($this->AmadeusConfig->lowFareRequestHeader($requestXML),$requestXML,$this->AmadeusConfig->lowFarePlusRequestWebServiceUrl);
        $this->AmadeusConfig->createXMlFile($search,'LowFarePlusRoundTripRS.XML');

        $responseXml   = $this->AmadeusConfig->mungXML($search);
        $xmlValidatorResponse = $this->AmadeusHelper->lowFarePlusResponseXMLValidator($responseXml);

        if($xmlValidatorResponse === 1){

            $sortedXMLResponse = $this->AmadeusHelper->lowFarePlusResponseSortFromXML($responseXml);

            $searchParam    = [
                'flight_search' => [
                    0 => [
                        'departure_city'   => $data->departure_city,
                        'destination_city' => $data->destination_city,
                        'departure_date'   => $data->departure_date,
                    ],
                    1 => [
                        'departure_city'   => $data->destination_city,
                        'destination_city' => $data->departure_city,
                        'departure_date'   => $data->return_date,
                    ]
                ],
                'no_of_adult'  => $data->no_of_adult,
                'no_of_infant' => $data->no_of_infant,
                'no_of_child'  => $data->no_of_child
            ];

            session()->put('flightSearchParam',$searchParam);
            session()->put('availableItineraries',$sortedXMLResponse);

            $returnedResponse = [
                'flightSearchParam'    => $searchParam,
                'availableItineraries' => $sortedXMLResponse
            ];

            return response()->json(["type" => "success",$returnedResponse], 200);

        }
        elseif($xmlValidatorResponse == 2){
            return response()->json(["type" => "error","message" => "No available itineraries for the search option"] ,200);
        }
        elseif(is_array($xmlValidatorResponse)){
            return response()->json(["type" => "error", "message" => $xmlValidatorResponse], 200);
        }
        elseif($xmlValidatorResponse == 0){
            return response()->json(["type" => "error","message" => "Connection error"] ,200);
        }

    }

    public function multiDestinationSearchV1(Request $data){
       
        $requestXML = $this->AmadeusRequestXML->lowFarePlusMultiDestinationRequestBodyXML($data);
        $this->AmadeusConfig->createXMlFile($requestXML,'LowFarePlusMultiDestinationRQ.XML');
        $search = $this->AmadeusConfig->callAmadeus($this->AmadeusConfig->lowFareRequestHeader($requestXML),$requestXML,$this->AmadeusConfig->lowFarePlusRequestWebServiceUrl);
        $this->AmadeusConfig->createXMlFile($search,'LowFarePlusMultiDestinationRS.XML');

        $responseXml   = $this->AmadeusConfig->mungXML($search);
        $xmlValidatorResponse = $this->AmadeusHelper->lowFarePlusResponseXMLValidator($responseXml);

        if($xmlValidatorResponse === 1){

            $sortedXMLResponse = $this->AmadeusHelper->lowFarePlusResponseSortFromXML($responseXml);

            $searchParam    = [
                'flight_search' => $data['originDestinations'],
                'no_of_adult'   => $data['searchParam']['no_of_adult'],
                'no_of_infant'  => $data['searchParam']['no_of_infant'],
                'no_of_child'   => $data['searchParam']['no_of_child']
            ];

            session()->put('flightSearchParam',$searchParam);
            session()->put('availableItineraries',$sortedXMLResponse);

            $returnedResponse = [
                'flightSearchParam'    => $searchParam,
                'availableItineraries' => $sortedXMLResponse
            ];

            return response()->json($returnedResponse, 200);

        }
        elseif($xmlValidatorResponse == 2){
            return response()->json(["type" => "error","message" => "No available itineraries for the search option"] ,200);
        }
        elseif(is_array($xmlValidatorResponse)){
            return response()->json(["type" => "error","message" => $xmlValidatorResponse], 200);
        }
        elseif($xmlValidatorResponse == 0){
            return response()->json(["type" => "error","message" => "Connection error"] ,200);
        }

    }

    public function priceItineraryV1(Request $data){

        $selectedItinerary =  $data['selectedItinerary'];

        $searchParam       =   $data['flightSearchParam'];

        $xml_post_string = $this->AmadeusRequestXML->airPriceRequestXML($selectedItinerary,$searchParam);
        $this->AmadeusConfig->createXMlFile($xml_post_string,'AirPriceRQ.XML');
        $getPricing = $this->AmadeusConfig->callAmadeus($this->AmadeusConfig->airPriceRequestHeader($xml_post_string),$xml_post_string,$this->AmadeusConfig->airPriceRequestWebServiceUrl);
        $this->AmadeusConfig->createXMlFile($getPricing,'AirPriceRS.XML');

        $responseXML = $this->AmadeusConfig->mungXML($getPricing);
        $responseValidator = $this->AmadeusHelper->airPriceResponseXMLValidator($responseXML);

        if($responseValidator === 1){
            $sortedResponse = $this->AmadeusHelper->airPriceResponseSort($responseXML);
            $itineraryPricingInfo = $sortedResponse;
            $priceChange = 0;
            if($selectedItinerary['defaultItineraryPrice'] != $itineraryPricingInfo['newTotalPrice']){
                $priceChange = $itineraryPricingInfo['newTotalPrice'] - $selectedItinerary['defaultItineraryPrice'];
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
                $markdownInfo       = Markdown::where('airline_code',$selectedItinerary['displayAirline'])->first();
                if(!is_null($markdownInfo)){
                    $airlineMarkdown = $this->AmadeusHelper->priceTypeCalculator($markdownInfo->type,$markdownInfo->type,$itineraryPricingInfo['newTotalPrice']);
                }
                $agentMarkup    = $this->AmadeusHelper->priceTypeCalculator($agentMarkupInfo->flight_markup_type,$agentMarkupInfo->flight_markup_type,$itineraryPricingInfo['newTotalPrice']);
                $customerMarkup = $this->AmadeusHelper->priceTypeCalculator($customerMarkupInfo->flight_markup_type,$customerMarkupInfo->flight_markup_type,$itineraryPricingInfo['newTotalPrice']);
                $adminMarkup    = 0;
                $vat            = $this->AmadeusHelper->priceTypeCalculator($vatInfo->flight_vat_type,$vatInfo->flight_vat_type,$itineraryPricingInfo['newTotalPrice']);

                $customerTotal = ($itineraryPricingInfo['newTotalPrice'] + $customerMarkup + $vat) - $airlineMarkdown;
                $agentTotal    = ($itineraryPricingInfo['newTotalPrice'] + $agentMarkup + $vat) - $airlineMarkdown;
                $adminTotal    = ($itineraryPricingInfo['newTotalPrice'] + $adminMarkup + $vat) - $airlineMarkdown;

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

                $selectedItinerary['defaultItineraryPrice'] = $itineraryPricingInfo['newTotalPrice'];
                $selectedItinerary['adminToCustomerMarkup'] = $customerMarkup;
                $selectedItinerary['adminToAgentMarkup'] = $agentMarkup;
                $selectedItinerary['customerTotal'] = $customerTotal;
                $selectedItinerary['agentTotal'] = $agentTotal;
                $selectedItinerary['adminTotal'] = $adminTotal;
                $selectedItinerary['displayTotal'] = $displayTotal;
                $selectedItinerary['itineraryPassengerInfo'] = $itineraryPricingInfo['passengerFareBrakeDown'];
            }
            $selectedItinerary['priceChange'] = $priceChange;

            $response = [
                'itineraryPricingInfo' => $sortedResponse,
                'updatedSelectedItinerary' => $selectedItinerary,
            ];
            return response()->json($response,200);
        }
        elseif($responseValidator == 2){
            return response()->json(['type' => 'error','message' => "Sorry, unable to get Itinerary Pricing"] ,200);
        }
        elseif(is_array($responseValidator)){
            return response()->json(['type' => 'success','message' =>$responseValidator, 200]);
        }
        elseif($responseValidator == 0){
            return response()->json(['type' => 'error','message' => "Connection error"] ,200);
        }

    }

    public function bookItineraryV1(Request $data){

        $user_id = $data['userId'];
        $user = User::find($user_id);
        $userProfile = Profile::getUserInfo($user_id);
        $user['profile'] =  $userProfile;


        $selectedItinerary = $data['updatedSelectedItinerary'];
        $passengerInfo = $data['passengerInfo'];

        $xml_post_string = $this->AmadeusRequestXML->flightTravelBuildRequestElementXML($passengerInfo,$selectedItinerary,$user);
        $this->AmadeusConfig->createXMlFile($xml_post_string,'FlightBuildRQ.XML');
        $build = $this->AmadeusConfig->callAmadeus($this->AmadeusConfig->travelBuildRequestHeader($xml_post_string),$xml_post_string,$this->AmadeusConfig->travelBuildRequestWebServiceUrl);
        $this->AmadeusConfig->createXMlFile($build,'FlightBuildRS.XML');

        $responseArray = $this->AmadeusConfig->mungXmlToArray($build);
        $validator   = $this->AmadeusHelper->flightBuildResponseValidator($responseArray);

        if($validator == 1){
            $voucher_id = 0;
            $voucher_amount = 0;
            $total_amount = 0;
            $markup = 0;
            if(auth()->user()->hasRole('agent')){
                $total_amount = $selectedItinerary['agentTotal'];
                $markup = $selectedItinerary['adminToAgentMarkup'];
            }
            elseif(auth()->user()->hasRole('admin')){
                $total_amount = $selectedItinerary['adminTotal'];
                $markup = $selectedItinerary['adminToAdminMarkup'];
            }
            elseif(auth()->user()->hasRole('customer')){
                $total_amount = $selectedItinerary['customerTotal'];
                $markup = $selectedItinerary['adminToCustomerMarkup'];
            }
            if(!empty($data['voucher_code']) || $data['voucher_code'] != 0){

                $checkVoucher = Voucher::where('code',$data['voucher_code'])
                    ->where('status',3)
                    ->first();

                if(!empty($checkVoucher) && !(is_null($checkVoucher))){
                    $voucher_id = $checkVoucher->id;
                    $voucher_amount = $checkVoucher->amount;
                    $total_amount = $total_amount - ($checkVoucher->amount);
                    $selectedItinerary['voucher_id']     = $voucher_id;
                    $selectedItinerary['voucher_amount'] = $voucher_amount;
                    $selectedItinerary['displayTotal']   = $total_amount;
                }
            }

            $selectedItinerary['markup'] = $markup;
            $sortedResponse = $this->AmadeusHelper->flightBuildResponseSort($responseArray);
            $saveBooking = FlightBooking::store($sortedResponse,$user,$selectedItinerary);
            if($saveBooking){
                return response()->json(['type' => 'success','message' => $saveBooking]);
            }
            else{
                $response = [
                  13,
                  'type' => 'success',
                  'message' => 'Itinerary was reserved successfully but we are unable to add this booking to our database',
                  'bookingResponse' => $sortedResponse,
                ];
                return response()->json($response,200);
            }
        }
        elseif($validator == 2){
            return response()->json(["message" => "Sorry, Unable to book Itinerary, try selecting another itinerary"] ,200);
        }
        elseif(is_array($validator)){
            return response()->json($validator, 200);
        }
        elseif($validator == 0){
            return response()->json(["message" => "Connection error"] ,200);
        }


    }

    public function getFlightBookingV1($pnr){

        $getBooking = FlightBooking::where('pnr',$pnr)->first();

        if(empty($getBooking) || is_null($getBooking)){
            return response()->json(['type' => 'error','message' => 'No booking is associated with this PNR in our database'],200);
        }
        return response()->json($getBooking,200);

    }

    public function getAllBookingsV1($userId){

        $getBooking = FlightBooking::where('user_id',$userId)->all();

        if(empty($getBooking) || is_null($getBooking)){
            return response()->json(['message' => 'No booking is associated with this user id in our database'],200);
        }
        return response()->json($getBooking,200);
    }

    public function paymentSuccessfulV1($pnr){
        $getBooking = FlightBooking::where('pnr',$pnr)->first();

        if(empty($getBooking) || is_null($getBooking)){
            return response()->json(['type' => 'error', 'message' => 'No booking is associated with this PNR in our database'],200);
        }

        $getBooking->payment_status = 1;
        $getBooking->update();

        return response()->json(['type' => 'success', 'message' => 'Payment status updated to successful'],200);

    }

    public function paymentPendingV1($pnr){
        $getBooking = FlightBooking::where('pnr',$pnr)->first();

        if(empty($getBooking) || is_null($getBooking)){
            return response()->json(['type' => 'error', 'message' => 'No booking is associated with this PNR in our database'],200);
        }

        $getBooking->payment_status = 0;
        $getBooking->update();

        return response()->json(['type' => 'success', 'message' => 'Payment status updated to pending'],200);
    }



}
