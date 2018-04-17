<?php
/**
 * Created by PhpStorm.
 * User: UniQue
 * Date: 4/5/2018
 * Time: 11:58 AM
 */

namespace App\Services;


class AmadeusConfig
{
    public $name = 'Amadeus';

    public $system = 'Test';

    public $userId = 'RubyTravel';

    public $password = 'sTeBr+Fr3kEv';

    public $pcc = 'MIA1S21AV';

    public $isoCurrency = 'NGN';

    public $requestorIdType = '21';

    public $requestorId = 'RubyTravel';



    public $lowFarePlusRequestWebServiceUrl     = 'http://amadeusws.tripxml.com/TripXML/wsLowFarePlus.asmx';

    public $lowFareMatrixRequestWebServiceUrl   = 'http://amadeusws.tripxml.com/TripXML/wsLowFareMatrix.asmx';

    public $lowFareScheduleRequestWebServiceUrl = 'http://amadeusws.tripxml.com/TripXML/wsLowFareSchedule.asmx';

    public $airSeatMapRequestWebServiceUrl      = 'http://amadeusws.tripxml.com/TripXML/wsAirSeatMap.asmx';

    public $airPriceRequestWebServiceUrl        = 'http://amadeusws.tripxml.com/TripXML/wsAirPrice.asmx';

    public $airRulesRequestWebServiceUrl        = 'http://amadeusws.tipxml.com/TripXML/wsAirRules_v03.asmx';

    public $airInfoRequestWebServiceUrl         = 'http://amadeusws.tripxml.com/TripXML/wsAirFlifo.asmx';

    public $travelBuildRequestWebServiceUrl     = 'http://amadeusws.tripxml.com/TripXML/wsTravelBuild_v03.asmx';

    public $cancelPrnRequestWebServiceUrl       = 'http://amadeusws.tripxml.com/TripXML/wsPNRCancel.asmx';

    public $pnrReadRequestWebServiceUrl         = 'http://amadeusws.tripxml.com/TripXML/wsPNRRead_v03.asmx';

    public $updateRequestWebServiceUrl          = 'http://amadeusws.tripxml.com/TripXML/wsUpdate.asmx';

    public $issueTicketRequestWebServiceUrl     = 'http://amadeusws.tripxml.com/TripXML/wsIssueTicket.asmx';

    public $voidTicketRequestWebServiceUrl      = 'http://amadeusws.tripxml.com/TripXML/wsVoidTicket.asmx';

    public $hotelAvailRequestWebServiceUrl      = 'http://amadeusws.tripxml.com/TripXML/wsHotelAvail.asmx';



    public static function airlineLogo($code){
        return 'http://pics.avs.io/200/200/'.$code.'.png';
    }


    public static function iataCode($string){

        if(strlen($string) == 3){
            return $string;
        }

        return substr($string, 0,3);
    }

    public static function cityImage($cityCode){
        return 'https://photo.hotellook.com/static/cities/960x720/'.$cityCode.'.jpg';
    }

    public function mungXmlToArray($xml){

        $obj = SimpleXML_Load_String($xml);
        if ($obj === FALSE) return $xml;
        // GET NAMESPACES, IF ANY
        $nss = $obj->getNamespaces(TRUE);
        if (empty($nss)) return $xml;

        // CHANGE ns: INTO ns_
        $nsm = array_keys($nss);
        foreach ($nsm as $key)
        {
            // A REGULAR EXPRESSION TO MUNG THE XML
            $rgx
                = '#'               // REGEX DELIMITER
                . '('               // GROUP PATTERN 1
                . '\<'              // LOCATE A LEFT WICKET
                . '/?'              // MAYBE FOLLOWED BY A SLASH
                . preg_quote($key)  // THE NAMESPACE
                . ')'               // END GROUP PATTERN
                . '('               // GROUP PATTERN 2
                . ':{1}'            // A COLON (EXACTLY ONE)
                . ')'               // END GROUP PATTERN
                . '#'               // REGEX DELIMITER
            ;
            // INSERT THE UNDERSCORE INTO THE TAG NAME
            $rep
                = '$1'          // BACKREFERENCE TO GROUP 1
                . '_'           // LITERAL UNDERSCORE IN PLACE OF GROUP 2
            ;
            // PERFORM THE REPLACEMENT
            $xml =  preg_replace($rgx, $rep, $xml);
        }
        return json_decode(json_encode(SimpleXML_Load_String($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    }

    public function mungXML($xml){
        $obj = SimpleXML_Load_String($xml);
        if ($obj === FALSE) return $xml;
        // GET NAMESPACES, IF ANY
        $nss = $obj->getNamespaces(TRUE);
        if (empty($nss)) return $xml;

        // CHANGE ns: INTO ns_
        $nsm = array_keys($nss);
        foreach ($nsm as $key)
        {
            // A REGULAR EXPRESSION TO MUNG THE XML
            $rgx
                = '#'               // REGEX DELIMITER
                . '('               // GROUP PATTERN 1
                . '\<'              // LOCATE A LEFT WICKET
                . '/?'              // MAYBE FOLLOWED BY A SLASH
                . preg_quote($key)  // THE NAMESPACE
                . ')'               // END GROUP PATTERN
                . '('               // GROUP PATTERN 2
                . ':{1}'            // A COLON (EXACTLY ONE)
                . ')'               // END GROUP PATTERN
                . '#'               // REGEX DELIMITER
            ;
            // INSERT THE UNDERSCORE INTO THE TAG NAME
            $rep
                = '$1'          // BACKREFERENCE TO GROUP 1
                . '_'           // LITERAL UNDERSCORE IN PLACE OF GROUP 2
            ;
            // PERFORM THE REPLACEMENT
            $xml =  preg_replace($rgx, $rep, $xml);
        }
        return $xml;
    }

    public function bookingReference(){
        return strtoupper(str_random('8'));
    }

    public function paymentReference(){
        return strtoupper(str_random('5'));
    }

    public function amadeusDate($date){
        return date('y-m-d',strtotime($date));
    }

    public function callAmadeus($headers,$xml_post_string,$requestUrl){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $requestUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);

        // curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_VERBOSE, false);

        // converting
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;

    }

    public function createXMlFile($response,$name){
        $file = fopen($name.'.xml','w');
        fwrite($file,$response);
        return fclose($file);
    }

    public function createTXTFile($response,$name){
        $file = fopen($name.'.txt','w');
        fwrite($file,$response);
        return fclose($file);
    }


    public function lowFareRequestHeader($xml_post_string){
        return [
            "POST /TripXML/wsLowFarePlus.asmx HTTP/1.1",
            "Host: amadeusws.tripxml.com",
            "Content-Type: text/xml; charset=utf-8",
            "SOAPAction: "."http://traveltalk.com/wsLowFarePlus/wmLowFarePlus",
            "Content-Length: ".strlen($xml_post_string)
            ];
    }

    public function lowFareMatrixRequestHeader($xml_post_string){
        return [
            "POST /TripXML/wsLowFareMatrix.asmx HTTP/1.1",
            "Host: amadeusws.tripxml.com",
            "Content-Type: text/xml; charset=utf-8",
            "SOAPAction: "."http://traveltalk.com/wsLowFareMatrix/wmLowFareMatrixXml",
            "Content-Length: ".strlen($xml_post_string)
        ];
    }

    public function lowFareScheduleRequestHeader($xml_post_string){
        return [
            "POST /TripXML/wsLowFareSchedule.asmx HTTP/1.1",
            "Host: amadeusws.tripxml.com",
            "Content-Type: text/xml; charset=utf-8",
            "SOAPAction: "."http://traveltalk.com/wsLowFareSchedule/wmLowFareScheduleXml",
            "Content-Length: ".strlen($xml_post_string)
        ];
    }

    public function airInfoRequestHeader($xml_post_string){
        return [
            "POST /TripXML/wsAirFlifo.asmx HTTP/1.1",
            "Host: amadeusws.tripxml.com",
            "Content-Type: text/xml; charset=utf-8",
            "SOAPAction: "."http://traveltalk.com/wsAirFlifo/wmAirFlifo",
            "Content-Length: ".strlen($xml_post_string)
        ];
    }

    public function airPriceRequestHeader($xml_post_string){

        return [
            "POST /TripXML/wsAirPrice.asmx HTTP/1.1",
            "Host: amadeusws.tripxml.com",
            "Content-Type: text/xml; charset=utf-8",
            "SOAPAction: "."http://traveltalk.com/wsAirPrice/wmAirPriceXml",
            "Content-Length: ".strlen($xml_post_string)
        ];
    }

    public function airSeatMapRequestHeader($xml_post_string){
        return [
            "POST /TripXML/wsAirSeatMap.asmx HTTP/1.1",
            "Host: amadeusws.tripxml.com",
            "Content-Type: text/xml; charset=utf-8",
            "SOAPAction: "."http://traveltalk.com/wsAirSeatMap/wmAirSeatMapXml",
            "Content-Length: ".strlen($xml_post_string)
        ];
    }

    public function travelBuildRequestHeader($xml_post_string){
        return [
            "POST /TripXML/wsTravelBuild_v03.asmx HTTP/1.1",
            "Host: amadeusws.tripxml.com",
            "Content-Type: text/xml; charset=utf-8",
            "SOAPAction: "."http://traveltalk.com/wsTravelBuild/wmTravelBuild",
            "Content-Length: ".strlen($xml_post_string)
        ];
    }

    public function cancelPnrRequestHeader($xml_post_string){
        return [
            "POST /TripXML/wsPNRCancel.asmx HTTP/1.1",
            "Host: amadeusws.tripxml.com",
            "Content-Type: text/xml; charset=utf-8",
            "SOAPAction: "."http://traveltalk.com/wsPNRCancel/wmPNRCancelXml",
            "Content-Length: ".strlen($xml_post_string)
        ];
    }

    public function issueTicketRequestHeader($xml_post_string){
        return [
            "POST /TripXML/wsIssueTicket.asmx HTTP/1.1",
            "Host: amadeusws.tripxml.com",
            "Content-Type: text/xml; charset=utf-8",
            "SOAPAction: "."http://traveltalk.com/wsIssueTicket/wmIssueTicketXml",
            "Content-Length: ".strlen($xml_post_string)
        ];
    }

    public function voidTicketRequestHeader($xml_post_string){
        return [
            "POST /TripXML/wsVoidTicket.asmx HTTP/1.1",
            "Host: amadeusws.tripxml.com",
            "Content-Type: text/xml; charset=utf-8",
            "SOAPAction: "."http://traveltalk.com/wsVoidTicket/wmVoidTicketXml",
            "Content-Length: ".strlen($xml_post_string)
        ];
    }

    public function pnrReadRequestHeader($xml_post_string){
        return [
            "POST /TripXML/wsPNRRead_v03.asmx HTTP/1.1",
            "Host: amadeusws.tripxml.com",
            "Content-Type: text/xml; charset=utf-8",
            "SOAPAction: "."http://traveltalk.com/wsPNRRead/wmPNRReadXml",
            "Content-Length: ".strlen($xml_post_string)
        ];
    }

    public function updatePnrRequestHeader($xml_post_string){
        return [
            "POST /TripXML/wsUpdate.asmx HTTP/1.1",
            "Host: amadeusws.tripxml.com",
            "Content-Type: text/xml; charset=utf-8",
            "SOAPAction: "."http://traveltalk.com/wsUpdate/wmUpdateXml",
            "Content-Length: ".strlen($xml_post_string)
        ];
    }




}