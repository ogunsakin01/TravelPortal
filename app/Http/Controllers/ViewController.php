<?php

namespace App\Http\Controllers;

use App\BankDetail;
use App\FlightBooking;
use App\Profile;
use App\Services\AmadeusConfig;
use App\Services\AmadeusHelper;
use App\Markup;
use App\Markdown;
use App\Vat;
use function Symfony\Component\VarDumper\Dumper\esc;

class ViewController extends Controller
{

    private $AmadeusHelper;

    private $AmadeusConfig;

    public function __construct(){
        $this->AmadeusHelper = new AmadeusHelper();
        $this->AmadeusConfig = new AmadeusConfig();
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

        return view('pages.flight.search_result',compact('availableItineraries','availableCabins','availableAirlines','minimumPrice','maximumPrice','availableStops','availablePrices'));
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

        return view('pages.flight.itinerary_booking',compact('itineraryPricingInfo','selectedItinerary','flightSearchParam','months'));

    }

    public function flightBookingPayment(){

        $itineraryPricingInfo   = session()->get('itineraryPricingInfo');
        $selectedItinerary      = session()->get('selectedItinerary');
        $flightSearchParam      = session()->get('flightSearchParam');
        $pnr = session()->get('pnr');
        $booking = FlightBooking::where('pnr',$pnr)->first();
        $banks = BankDetail::where('status',1)->get();

        return view('pages.flight.payment_option',compact('itineraryPricingInfo','selectedItinerary','flightSearchParam','booking','banks'));

    }

    public function flightPaymentConfirmation(){

          $paymentInfo            = session()->get('paymentInfo');
          $itineraryPricingInfo   = session()->get('itineraryPricingInfo');
          $selectedItinerary      = session()->get('selectedItinerary');
          $flightSearchParam      = session()->get('flightSearchParam');
          $pnr = session()->get('pnr');
          $booking = FlightBooking::where('pnr',$pnr)->first();
          $profile = Profile::getUserInfo(auth()->user()->id);
          return view('pages.flight.payment_confirmation',compact('paymentInfo','itineraryPricingInfo','selectedItinerary','flightSearchParam','booking','profile'));

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

        dd($this->palindrome("Was it a car or a cat I saw"));

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
        return view('pages.hotel.search_result',compact('availableHotels','hotelSearchParam','minimumPrice','maximumPrice','starRatings','availablePrices'));

    }

    public function hotelInformation(){




        $selectedHotel = session()->get('selectedHotelInformation');
        $hotelInformation = $this->AmadeusHelper->hotelAvailRoomResponseSort($selectedHotel);
//        dd($hotelInformation);
        return view('pages.hotel.hotel_details',compact('hotelInformation'));
    }

}
