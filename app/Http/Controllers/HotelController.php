<?php

namespace App\Http\Controllers;

use App\HotelBooking;
use App\Services\PortalCustomNotificationHandler;
use App\User;
use Illuminate\Http\Request;
use App\Services\AmadeusConfig;
use App\Services\AmadeusRequestXML;
use App\Services\AmadeusHelper;
use nilsenj\Toastr\Facades\Toastr;

class HotelController extends Controller
{

    private $AmadeusConfig;

    private $AmadeusRequestXML;

    private $AmadeusHelper;

    public function __construct(){
        $this->AmadeusConfig     = new AmadeusConfig();
        $this->AmadeusRequestXML = new AmadeusRequestXML();
        $this->AmadeusHelper     = new AmadeusHelper();
    }

    public function searchHotel(Request $data){

        $requestXMl = $this->AmadeusRequestXML->hotelAvailRequestXml($data);
        $this->AmadeusConfig->createXMlFile($requestXMl,'hotelAvailRQ');
        $availableHotel = $this->AmadeusConfig->callAmadeus($this->AmadeusConfig->hotelAvailRequestHeader($requestXMl),$requestXMl,$this->AmadeusConfig->hotelAvailRequestWebServiceUrl);
        $this->AmadeusConfig->createXMlFile($availableHotel,'hotelAvailRS');

        $responseArray = $this->AmadeusConfig->mungXmlToArray($availableHotel);
        $validator = $this->AmadeusHelper->hotelAvailResponseValidator($responseArray);

        if($validator == 1){
         $hotelSearchParam = [
             'hotel_city'     => $data['hotel_city'],
             'check_in_date'  => $data['check_in_date'],
             'check_out_date' => $data['check_out_date'],
             'adult_count'    => $data['adult_count'],
             'child_count'    => $data['child_count']
         ];
         session()->put('hotelSearchParam',$hotelSearchParam);
         session()->put('availableHotels',$responseArray);
        }

        return $validator;

    }

    public function getSelectedHotelInformation($id){
        $hotels = session()->get('availableHotels');
        $availableHotels = $this->AmadeusHelper->hotelAvailResponseSort($hotels);
        return $availableHotels[$id];
    }

    public function getSelectHotelRoomsInformation($id){

        $hotelSearchParam = session()->get('hotelSearchParam');
        $selectedHotel = $this->getSelectedHotelInformation($id);

        $requestXML = $this->AmadeusRequestXML->hotelAvailRoomRequestXML($hotelSearchParam,$selectedHotel);
        $this->AmadeusConfig->createXMlFile($requestXML,'hotelAvailRoomRQ');
        $availableHotelRoom = $this->AmadeusConfig->callAmadeus($this->AmadeusConfig->hotelAvailRequestHeader($requestXML),$requestXML,$this->AmadeusConfig->hotelAvailRequestWebServiceUrl);
        $this->AmadeusConfig->createXMlFile($availableHotelRoom,'hotelAvailRoomRS');

        $responseArray = $this->AmadeusConfig->mungXmlToArray($availableHotelRoom);
        $validator     = $this->AmadeusHelper->hotelAvailResponseValidator($responseArray);

        if($validator == 1){
            session()->put('selectedHotelInformation',$responseArray);
        }
        return $validator;
    }

    public function hotelRoomInformation(){
        $selectedHotelRoomInformation = session()->get('selectedHotelRoomInformation');
        dd($selectedHotelRoomInformation);
    }

    public function selectedHotel(){
        $selectedHotel = session()->get('selectedHotelInformation');
        $hotelInformation = $this->AmadeusHelper->hotelAvailRoomResponseSort($selectedHotel);
        return $hotelInformation;
    }

    public function getSelectedHotelRoomInformation($id){

        $selectedRoomInformation  = $this->selectedHotel()['availableRooms'][$id];
        $selectedHotelInformation = $this->selectedHotel();
        $searchParam = session()->get('hotelSearchParam');
        $requestXML = $this->AmadeusRequestXML->hotelAvailRoomDetailsRequestXML($selectedRoomInformation,$selectedHotelInformation,$searchParam);
        $this->AmadeusConfig->createXMlFile($requestXML,'HotelRoomDetailsRQ');
        $roomInfo = $this->AmadeusConfig->callAmadeus($this->AmadeusConfig->hotelAvailRequestHeader($requestXML),$requestXML,$this->AmadeusConfig->hotelAvailRequestWebServiceUrl);
        $this->AmadeusConfig->createXMlFile($roomInfo,'HotelRoomDetailsRS');

        $responseArray = $this->AmadeusConfig->mungXmlToArray($roomInfo);
        $validator     = $this->AmadeusHelper->hotelAvailResponseValidator($responseArray);


        if($validator == 1){
            session()->put('selectedHotelRoomInformation',$responseArray);
        }
        return $validator;
    }

    public function holdCustomerHotelBookingInfo(Request $data){
       session()->put('hotel-booking-customer',$data->toArray());
       $selectedRoom = session()->get('selectedRoom');
       $selectedHotel = $this->selectedHotel();
       $searchParam   = session()->get('hotelSearchParam');
       $markUp = 0; $markDown = 0; $totalAmount = 0;
       $user = auth()->user();
      if($user->hasRole('admin')){
        $markUp = 0;
        $markDown = 0;
        $totalAmount = $selectedRoom['roomPrice'];
      }elseif($user->hasRole('agent')){
          $markUp = $selectedRoom['agentMarkUp'];
          $markDown = $selectedRoom['agentMarkDown'];
          $totalAmount = $selectedRoom['agentTotalAmount'];
      }elseif($user->hasRole('customer')){
          $markUp = $selectedRoom['customerMarkUp'];
          $markDown = $selectedRoom['customerMarkDown'];
          $totalAmount = $selectedRoom['customerTotalAmount'];
      }

        $hotelBookingReference = "HOT-".strtoupper(str_random(6));
        $selectedRoom['bookingReference'] = $hotelBookingReference;
        $selectedRoom['totalAmount'] = $totalAmount;
        $selectedRoom['markUp'] = $markUp;
        $selectedRoom['markDown'] = $markDown;
        session()->put('selectedRoom',$selectedRoom);

        $booking = new HotelBooking();
        $booking->user_id = auth()->user()->id;
        $booking->reference = $hotelBookingReference;
        $booking->pnr = '';
        $booking->hotel_name = $selectedHotel['hotelName'];
        $booking->hotel_code = $selectedHotel['hotelCode'];
        $booking->hotel_city_code = $selectedHotel['hotelCityCode'];
        $booking->hotel_chain_code = $selectedHotel['chainCode'];
        $booking->room_booking_code = $selectedRoom['bookingCode'];
        $booking->rate_plan_code = $selectedRoom['ratePlanCode'];
        $booking->guarantee = $selectedRoom['guarantee'];
        $booking->adult_guest = $searchParam['adult_count'];
        $booking->child_guest = $searchParam['child_count'];
        $booking->check_in_date = $searchParam['check_in_date'];
        $booking->check_out_date = $searchParam['check_out_date'];
        $booking->base_amount = $selectedRoom['roomPrice'];
        $booking->hotel_context_code = $selectedHotel['hotelContextCode'];
        $booking->vat = $selectedRoom['vat'];
        $booking->markup = $markUp;
        $booking->markdown = $markDown;
        $booking->voucher_id = 0;
        $booking->voucher_amount = 0;
        $booking->total_amount = $totalAmount;
        $booking->expiry_date = $searchParam['check_in_date'];
        $booking->payment_status = 0;
        $booking->reservation_status = 0;
        $booking->cancellation_status = 0;
        $booking->pnr_request_response = '';
       if($booking->save()){
            return redirect(url('/hotel-booking-payment-page'));
       }
       Toastr::error('Unable to save your booking, please try again later');
       return back();
    }

    public function hotelPaymentConfirmation(){
        $paymentInfo = session()->get('paymentInfo');
        $selectedRoom = session()->get('selectedRoom');
        $selectedHotel = $this->selectedHotel();
        $searchParam   = session()->get('hotelSearchParam');
        $bookingCustomer = session()->get('hotel-booking-customer');
        $user = User::authenticatedUserInfo();
        if($paymentInfo['status'] == 1){

            $buildRequestXML = $this->AmadeusRequestXML->hotelTravelBuildRequestElementXML($selectedRoom,$selectedHotel,$searchParam,$bookingCustomer);
            $this->AmadeusConfig->createXMlFile($buildRequestXML,'hotelBuildRQ');
            $reserveHotel = $this->AmadeusConfig->callAmadeus($this->AmadeusConfig->travelBuildRequestHeader($buildRequestXML),$buildRequestXML,$this->AmadeusConfig->travelBuildRequestWebServiceUrl);
            $this->AmadeusConfig->createXMlFile($reserveHotel,'hotelBuildRS');

            $responseArray = $this->AmadeusConfig->mungXmlToArray($reserveHotel);
            $validator = $this->AmadeusHelper->hotelTravelBuildResponseValidator($responseArray);

            if($validator == 1){
                $hotelBookingStatus = 1;
                $hotelBookingMessage = "Room booking successful";
                $hotelBooking = HotelBooking::where('reference',$selectedRoom['bookingReference'])->first();
                $hotelBooking->pnr = $responseArray['soap_Body']['wmTravelBuildResponse']['OTA_TravelItineraryRS']['TravelItinerary']['ItineraryRef']['@attributes']['ID'];
                $hotelBooking->reservation_status = 1;
                $hotelBooking->pnr_request_response = json_encode($responseArray['soap_Body']['wmTravelBuildResponse']['OTA_TravelItineraryRS']['TravelItinerary']);
                $hotelBooking->update();
                PortalCustomNotificationHandler::bookHotelRoom($user,$selectedHotel,$selectedRoom,$hotelBooking);
            }else{
                $hotelBookingStatus = 2;
                $hotelBookingMessage = "Unable to book room";
            }
        }
        else{
            $hotelBookingStatus = 0;
            $hotelBookingMessage = "Unable to confirm payment, we could not proceed with the booking of this hotel, kindly login to your account to manage this booking or try again later";
        }
        $paymentInfo['hotelBookingStatus'] = $hotelBookingStatus;
        $paymentInfo['hotelBookingMessage'] = $hotelBookingMessage;
        session()->put('paymentInfo',$paymentInfo);

        return redirect('/hotel-booking-completion');
    }

    public function reBookHotelRoom($reference){

        $hotelBooking = HotelBooking::where('reference',$reference)->first();
        $user = User::authenticatedUserInfo();
        $buildRequestXML = $this->AmadeusRequestXML->hotelTravelBuildRebookRequestElementXML($hotelBooking,$user);
        $this->AmadeusConfig->createXMlFile($buildRequestXML,'hotelBuildRQ');
        $reserveHotel = $this->AmadeusConfig->callAmadeus($this->AmadeusConfig->travelBuildRequestHeader($buildRequestXML),$buildRequestXML,$this->AmadeusConfig->travelBuildRequestWebServiceUrl);
        $this->AmadeusConfig->createXMlFile($reserveHotel,'hotelBuildRS');

        $responseArray = $this->AmadeusConfig->mungXmlToArray($reserveHotel);
        $validator = $this->AmadeusHelper->hotelTravelBuildResponseValidator($responseArray);

        if($validator == 1){
            $hotelBookingStatus = 1;
            $hotelBookingMessage = "Room booking successful";
            $hotelBooking->pnr = $responseArray['soap_Body']['wmTravelBuildResponse']['OTA_TravelItineraryRS']['TravelItinerary']['ItineraryRef']['@attributes']['ID'];
            $hotelBooking->reservation_status = 1;
            $hotelBooking->pnr_request_response = json_encode($responseArray['soap_Body']['wmTravelBuildResponse']['OTA_TravelItineraryRS']['TravelItinerary']);
            $hotelBooking->update();
        }

        return $validator;

    }

}
