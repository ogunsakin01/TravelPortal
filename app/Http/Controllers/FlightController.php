<?php

namespace App\Http\Controllers;

use App\FlightBooking;
use App\Profile;
use App\Services\AmadeusConfig;
use App\Services\AmadeusRequestXML;
use App\Services\AmadeusHelper;
use App\Services\PortalCustomNotificationHandler;
use Illuminate\Http\Request;
use nilsenj\Toastr\Facades\Toastr;
use App\Markdown;
use App\Markup;
use App\Vat;
use App\Voucher;
use App\User;

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


        $responseXml   = $this->AmadeusConfig->mungXML($search);
        $xmlValidatorResponse = $this->AmadeusHelper->lowFarePlusResponseXMLValidator($responseXml);

        if($xmlValidatorResponse === 1){

            $sortedXMLResponse = $this->AmadeusHelper->lowFarePlusResponseSortFromXML($responseXml);

            $searchParam    = [
                'flight_search' => [
                    0 => [
                        'departure_city'   => $data['departure_city'],
                        'destination_city' => $data['destination_city'],
                        'departure_date'   => $data['departure_date'],
                    ]
                ],
                'no_of_adult'  => $data['no_of_adult'],
                'no_of_infant' => $data['no_of_infant'],
                'no_of_child'  => $data['no_of_child']
            ];

            session()->put('flightSearchParam',$searchParam);
            session()->put('availableItineraries',$sortedXMLResponse);

        }
        return $xmlValidatorResponse;
    }

    public function roundTripFlightSearch(Request $data){

        $requestXML = $this->AmadeusRequestXML->lowFarePlusRequestBodyXML($data);
        $this->AmadeusConfig->createXMlFile($requestXML,'LowFarePlusTurnAroundRQ.XML');
        $search = $this->AmadeusConfig->callAmadeus($this->AmadeusConfig->lowFareRequestHeader($requestXML),$requestXML,$this->AmadeusConfig->lowFarePlusRequestWebServiceUrl);
        $this->AmadeusConfig->createXMlFile($search,'LowFarePlusTurnAroundRS.XML');

        $responseXml   = $this->AmadeusConfig->mungXML($search);
        $xmlValidatorResponse = $this->AmadeusHelper->lowFarePlusResponseXMLValidator($responseXml);

        if($xmlValidatorResponse === 1){

          $sortedXMLResponse = $this->AmadeusHelper->lowFarePlusResponseSortFromXML($responseXml);

          $searchParam    = [
              'flight_search' => [
                  0 => [
                      'departure_city'   => $data['departure_city'],
                      'destination_city' => $data['destination_city'],
                      'departure_date'   => $data['departure_date'],
                  ],
                  1 => [
                      'departure_city'   => $data['destination_city'],
                      'destination_city' => $data['departure_city'],
                      'departure_date'   => $data['return_date'],
                  ]
              ],
              'no_of_adult'  => $data['no_of_adult'],
              'no_of_infant' => $data['no_of_infant'],
              'no_of_child'  => $data['no_of_child']
          ];

          session()->put('flightSearchParam',$searchParam);
          session()->put('availableItineraries',$sortedXMLResponse);

        }
        return $xmlValidatorResponse;

    }

    public function multiDestinationFlightSearch(Request $data){

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

        }
        return $xmlValidatorResponse;
    }

    public function selectedItineraryInfo($id){
        $availableItineraries = session()->get('availableItineraries');
        return json_encode($availableItineraries[$id]);
    }

    public function getItineraryInformationAndPricing($id){

        $selectedItinerary =  $this->selectedItineraryInfo($id);
        $selectedItinerary = (array) json_decode($selectedItinerary);
        $searchParam       =  session()->get('flightSearchParam');


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
                Toastr::info('The price of this Itinerary has changed, review the new price before booking.');
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

            session()->put('selectedItinerary',$selectedItinerary);
            session()->put('itineraryPricingInfo',$sortedResponse);
        }

        return $responseValidator;

    }

    public function bookItinerary(Request $data){

        $user = auth()->user();
        $userProfile = Profile::getUserInfo($user->id);
        $user['profile'] =  $userProfile;

        $selectedItinerary = session()->get('selectedItinerary');
        $xml_post_string = $this->AmadeusRequestXML->flightTravelBuildRequestElementXML($data->all(),$selectedItinerary,$user);
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
            if(!empty($data->voucher_code) || $data->voucher_code != 0){

                $checkVoucher = Voucher::where('code',$data->voucher_code)
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
                session()->put('selectedItinerary',$selectedItinerary);
                session()->put('pnr',$sortedResponse['pnr']);
                return redirect(url('/flight-booking-payment-page'));
            }
            else{
                Toastr::error('Sorry, an unknown error was encountered');
                return back();
            }
        }
        else{
            if(is_array($validator)){
                if(is_array($validator[1])){
                    foreach($validator[1] as $i => $error){
                        Toastr::error($error);
                    }
                }
                else{
                    Toastr::error($validator[1]);
                }
                $error = json_encode($validator[1]);
            }
            else{
                $error = 'Sorry, this itinerary is not available for booking, try again with another itinerary';
                Toastr::error('Sorry, this itinerary is not available for booking, try again with another itinerary');
            }
            return back()->withErrors($error);
        }
    }

    public function cancelPNR($pnr){

        $requestXML = $this->AmadeusRequestXML->cancelPNRRequestXML($pnr);
        $this->AmadeusConfig->createXMlFile($requestXML,'cancelPNRRQ');
        $cancel = $this->AmadeusConfig->callAmadeus($this->AmadeusConfig->cancelPnrRequestHeader($requestXML),$requestXML,$this->AmadeusConfig->cancelPNRRequestWebServiceUrl);
        $this->AmadeusConfig->createXMlFile($cancel,'cancelPNRRS');

        $responseArray = $this->AmadeusConfig->mungXmlToArray($cancel);
        $validator = $this->AmadeusHelper->cancelPNRResponseValidator($responseArray);
        if($validator == 1){
            $booking = FlightBooking::where('pnr',$pnr)->first();
            $booking->cancel_ticket_status = 1;
            $booking->update();
            $user = User::find($booking->user_id);
            $profile = Profile::where('user_id',$booking->user_id)->first();
            $user['profile'] = $profile;
            PortalCustomNotificationHandler::reservationCancelled($user,$pnr);
        }
        return $validator;
    }

    public function voidTicket($ticketNumber){

        $requestXML = $this->AmadeusRequestXML->voidTicket($ticketNumber);
        $this->AmadeusConfig->createXMlFile($requestXML,'voidTicketRQ');
        $voidTicket = $this->AmadeusConfig->callAmadeus($this->AmadeusConfig->voidTicketRequestHeader($requestXML),$requestXML,$this->AmadeusConfig->voidTicketRequestWebServiceUrl);
        $this->AmadeusConfig->createXMlFile($voidTicket,'voidTicketRS');

        $responseArray = $this->AmadeusConfig->mungXmlToArray($voidTicket);
        return $responseArray;

    }

    public function issueTicket($pnr){
        $requestXML = $this->AmadeusRequestXML->issueTicket($pnr);
        $this->AmadeusConfig->createXMlFile($requestXML,'issueTicketRQ');
        $issueTicket = $this->AmadeusConfig->callAmadeus($this->AmadeusConfig->issueTicketRequestHeader($requestXML),$requestXML,$this->AmadeusConfig->issueTicketRequestWebServiceUrl);
        $this->AmadeusConfig->createXMlFile($issueTicket,'issueTicketRS');

        $responseArray = $this->AmadeusConfig->mungXmlToArray($issueTicket);
        $validator = $this->AmadeusHelper->issueTicketResponseValidator($responseArray);
        if($validator == 1){
            $booking = FlightBooking::where('pnr',$pnr)->first();
            $booking->issue_ticket_status = 1;
            $booking->update();
            $user = User::find($booking->user_id);
            $profile = Profile::where('user_id',$booking->user_id)->first();
            $user['profile'] = $profile;
            PortalCustomNotificationHandler::ticketIssued($user,$pnr);
        }
        return $validator;
    }



}
