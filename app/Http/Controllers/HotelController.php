<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AmadeusConfig;
use App\Services\AmadeusRequestXML;
use App\Services\AmadeusHelper;

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
}
