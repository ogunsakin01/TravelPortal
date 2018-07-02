<?php

namespace App\Http\Controllers;

use App\BankDetail;
use App\FlightBooking;
use App\HotelBooking;
use App\Profile;
use App\Services\AmadeusConfig;
use App\Services\AmadeusHelper;
use App\Markup;
use App\Title;
use App\Vat;
use App\TravelPackage;
use function Symfony\Component\VarDumper\Dumper\esc;

class ViewController extends Controller
{

    private $AmadeusHelper;

    private $AmadeusConfig;

    private $HotelController;

    public function __construct(){
        $this->AmadeusHelper = new AmadeusHelper();
        $this->AmadeusConfig = new AmadeusConfig();
        $this->HotelController = new HotelController();
    }

    public function home(){

        $deals = TravelPackage::where('status', 1)
            ->with('images')
            ->with('flightDeal')
            ->with('hotelDeal')
            ->with('attractionDeal')
            ->limit(15)
            ->get();

        return view('pages.frontend.home',compact('deals'));

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

        return view('pages.frontend.flight.search_result',compact('availableItineraries','availableCabins','availableAirlines','minimumPrice','maximumPrice','availableStops','availablePrices'));
    }

    public function itineraryBooking(){

        $itineraryPricingInfo = session()->get('itineraryPricingInfo');
        $selectedItinerary    = session()->get('selectedItinerary');
        $flightSearchParam    = session()->get('flightSearchParam');

        $months = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];

        return view('pages.frontend.flight.itinerary_booking',compact('itineraryPricingInfo','selectedItinerary','flightSearchParam','months'));

    }

    public function flightBookingPayment(){

        $itineraryPricingInfo   = session()->get('itineraryPricingInfo');
        $selectedItinerary      = session()->get('selectedItinerary');
        $flightSearchParam      = session()->get('flightSearchParam');
        $pnr = session()->get('pnr');
        $booking = FlightBooking::where('pnr',$pnr)->first();
        $banks = BankDetail::where('status',1)->get();

        return view('pages.frontend.flight.payment_option',compact('itineraryPricingInfo','selectedItinerary','flightSearchParam','booking','banks'));

    }

    public function flightPaymentConfirmation(){

          $paymentInfo            = session()->get('paymentInfo');
          $itineraryPricingInfo   = session()->get('itineraryPricingInfo');
          $selectedItinerary      = session()->get('selectedItinerary');
          $flightSearchParam      = session()->get('flightSearchParam');
          $pnr = session()->get('pnr');
          $booking = FlightBooking::where('pnr',$pnr)->first();
          $profile = Profile::getUserInfo(auth()->user()->id);
          return view('pages.frontend.flight.payment_confirmation',compact('paymentInfo','itineraryPricingInfo','selectedItinerary','flightSearchParam','booking','profile'));

    }

    public function palindrome($string){
        $cleanString = preg_replace("/[^a-zA-Z]+/","",$string);
        $stringLength = strlen($cleanString);
        $validator = 0;
        for($i = 0; $i < $stringLength; $i++){
            $initial = strtolower(substr($cleanString,$i,1));
            $later = strtolower(substr($cleanString,(-1-$i),1));
            if($initial != $later){
                $validator = $validator + 1;
            }
        }
        if($validator > 0){
            return "It is not a palindrome";
        }
        return "It is a palindrome";
    }

    public function availableHotels(){


        $hotels = session()->get('availableHotels');

        $hotelSearchParam = session()->get('hotelSearchParam');

        $availableHotels =  $this->AmadeusHelper->hotelAvailResponseSort($hotels);

        $ratings = [];
        $prices = [];
        foreach($availableHotels as $serial => $availableHotel){
            array_push($ratings,$availableHotel['hotelStarRating']);
            array_push($prices,round($availableHotel['minimumRate'] / 100));
        }

        $starRatings = array_values(array_unique($ratings));
        $minimumPrice = round(min($availableHotels)['minimumRate'] / 100);
        $maximumPrice = round(max($availableHotels)['minimumRate'] / 100);
        $availablePrices = json_encode(array_values(array_unique($prices)));
        return view('pages.frontend.hotel.search_result',compact('availableHotels','hotelSearchParam','minimumPrice','maximumPrice','starRatings','availablePrices'));

    }

    public function hotelInformation(){
        $selectedHotel = session()->get('selectedHotelInformation');
        $hotelInformation = $this->AmadeusHelper->hotelAvailRoomResponseSort($selectedHotel);
        return view('pages.frontend.hotel.hotel_details',compact('hotelInformation'));
    }

    public function hotelRoomBooking($id){

        $hotelInformation = $this->HotelController->selectedHotel();
        $searchParam      = session()->get('hotelSearchParam');
        $selectedRoom     = $hotelInformation['availableRooms'][$id];
        $hotelRoomInformation = session()->get('selectedHotelRoomInformation');
        $vat = 0;
        $adminMarkDown = 0;
        $agentMarkDown = 0;
        $agentMarkup = 0;
        $customerMarkDown = 0;
        $customerMarkup = 0;
        $voucherId = 0;
        $voucherAmount = 0;
        $totalAmount = 0;

        $agentMarkupInfo    = Markup::where('role_id', 2)->first();
        $customerMarkupInfo = Markup::where('role_id', 3)->first();
        $vatInfo            = Vat::where('id',1)->first();

        $agentMarkup    = $this->AmadeusHelper->priceTypeCalculator($agentMarkupInfo->hotel_markup_type,$agentMarkupInfo->hotel_markup_type,$selectedRoom['roomPrice']);
        $customerMarkup = $this->AmadeusHelper->priceTypeCalculator($customerMarkupInfo->hotel_markup_type,$customerMarkupInfo->hotel_markup_type,$selectedRoom['roomPrice']);
        $adminMarkup    = 0;
        $vat            = $this->AmadeusHelper->priceTypeCalculator($vatInfo->hotel_vat_type,$vatInfo->hotel_vat_type,$selectedRoom['roomPrice']);

        $adminTotalAmount = $selectedRoom['roomPrice'];
        $agentTotalAmount = $selectedRoom['roomPrice'] + $agentMarkup - $agentMarkDown + $vat;
        $customerTotalAmount = $selectedRoom['roomPrice'] + $customerMarkup - $customerMarkDown + $vat;

        $selectedRoom['vat'] = round($vat);
        $selectedRoom['agentMarkDown'] = round($agentMarkDown);
        $selectedRoom['agentMarkUp'] = round($agentMarkup);
        $selectedRoom['customerMarkDown'] = round($customerMarkDown);
        $selectedRoom['customerMarkUp'] = round($customerMarkup);
        $selectedRoom['adminMarkDown'] = round($adminMarkDown);
        $selectedRoom['adminMarkUp'] = round($adminMarkup);
        $selectedRoom['voucherId'] = $voucherId;
        $selectedRoom['voucherAmount'] = $voucherAmount;
        $selectedRoom['adminTotalAmount']    = round($adminTotalAmount);
        $selectedRoom['agentTotalAmount']    = round($agentTotalAmount);
        $selectedRoom['customerTotalAmount'] = round($customerTotalAmount);

        session()->put('selectedRoom',$selectedRoom);
        $titles = Title::all();
        return view('pages.frontend.hotel.hotel_booking',compact('hotelRoomInformation','searchParam','selectedRoom','hotelInformation','titles'));

    }

    public function hotelBookingPaymentPage(){
        $hotelInformation = $this->HotelController->selectedHotel();
        $searchParam      = session()->get('hotelSearchParam');
        $selectedRoom     = session()->get('selectedRoom');
        $hotelRoomInformation = session()->get('selectedHotelRoomInformation');
        $banks = BankDetail::where('status',1)->get();
        $titles = Title::all();
        return view('pages.frontend.hotel.hotel_payment_option',compact('hotelRoomInformation','searchParam','selectedRoom','hotelInformation','banks','titles'));
    }

    public function hotelBookingCompletion(){
        $hotelInformation = $this->HotelController->selectedHotel();
        $searchParam      = session()->get('hotelSearchParam');
        $selectedRoom     = session()->get('selectedRoom');
        $paymentInfo      = session()->get('paymentInfo');
        $bookingInfo      = HotelBooking::where('reference',$selectedRoom['bookingReference'])->first();


        return view('pages.frontend.hotel.hotel_payment_confirmation',compact('hotelInformation','searchParam','selectedRoom','paymentInfo','bookingInfo'));
    }

    public function flightDeals(){

        $flights = TravelPackage::where('attraction',0)
            ->where('hotel', 0)
            ->where('flight', 1)
            ->where('status', 1)
            ->orderBy('id','desc')
            ->paginate(8);

        return view('pages.frontend.deal.flight',compact('flights'));
    }

    public function hotelDeals(){

        $hotelDeals = TravelPackage::orderBy('id','desc')
            ->where('attraction',0)
            ->where('hotel', 1)
            ->where('flight', 0)
            ->where('status', 1)
            ->with('images')
            ->with('hotelDeal')
            ->get();
        return view('pages.frontend.deal.hotel',compact('hotelDeals'));
    }

    public function attractionDeals(){

        $attractionDeals = TravelPackage::where('attraction',1)
            ->where('hotel', 0)
            ->where('flight', 0)
            ->where('status', 1)
            ->orderBy('id','desc')
            ->with('images')
            ->with('sightSeeing')
            ->orderBy('id','desc')
            ->paginate(8);
        return view('pages.frontend.deal.attraction',compact('attractionDeals'));

    }

    public function hotDeals(){

        $hotDeals = TravelPackage::where('status', 1)
            ->with('flightDeal')
            ->with('hotelDeal')
            ->with('attractionDeal')
            ->with('sightSeeing')
            ->with('images')
            ->orderBy('id','desc')
            ->paginate(8);
        return view('pages.frontend.deal.attraction',compact('hotDeals'));
    }


    public function dealDetails($id){

        $deal = TravelPackage::where('id',$id)
            ->with('hotelDeal')
            ->with('flightDeal')
            ->with('attractionDeal')
            ->with('sightSeeing')
            ->with('images')
            ->first();

        if($deal->status != 1){
            Toastr::error("The package you are trying to get is not active.");
            return back();
        }

        return view('pages.frontend.deal.details',compact('deal'));
    }

    public function dealBooking($id){

        $deal = TravelPackage::where('id',$id)
            ->with('hotelDeal')
            ->with('flightDeal')
            ->with('attractionDeal')
            ->with('sightSeeing')
            ->with('images')
            ->first();

        $titles = Title::all();

        if($deal->status != 1){
            Toastr::error("The package you are trying to get is not active.");
            return back();
        }

        return view('pages.frontend.deal.bookings',compact('deal','titles'));

    }

    public function dealPaymentOptions(){

        $booking_id = session()->get('deal_booking_id');

        $booking = PackageBooking::find($booking_id);

        $deal = TravelPackage::where('id',$booking->package_id)
            ->with('hotelDeal')
            ->with('flightDeal')
            ->with('attractionDeal')
            ->with('sightSeeing')
            ->with('images')
            ->first();

        $banks = BankDetail::where('status',1)->get();

        $titles = Title::all();

        return view('pages.frontend.deal.payment_options',compact('booking','deal','banks','titles'));

    }

    public function dealBookingConfirmation(){

        $booking_id = session()->get('deal_booking_id');

        $booking = PackageBooking::find($booking_id);

        $deal = TravelPackage::where('id',$booking->package_id)
            ->with('hotelDeal')
            ->with('flightDeal')
            ->with('attractionDeal')
            ->with('sightSeeing')
            ->with('images')
            ->first();

        $paymentInfo = session()->get('paymentInfo');

        return view('pages.frontend.deal.booking_confirmation',compact('booking','deal','paymentInfo'));

    }

}
