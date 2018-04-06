<?php
/**
 * Created by PhpStorm.
 * User: UniQue
 * Date: 4/6/2018
 * Time: 1:09 PM
 */

namespace App\Services;


class AmadeusRequestXML
{

    public function __construct(){

        $this->AmadeusConfig = new AmadeusConfig();
        $this->PortalConfig  = new PortalConfig();
    }

    public function headerGenerator(){
          return '';
    }

    public function posXML(){
        return '<POS>
        <Source PseudoCityCode="'.$this->AmadeusConfig->pcc.'" ISOCurrency="'.$this->AmadeusConfig->isoCurrency.'">
         <RequestorID Type="'.$this->AmadeusConfig->requestorIdType.'" ID="'.$this->AmadeusConfig->requestorId.'"/>
        </Source>
         <TPA_Extensions>
            <Provider>
               <Name>'.$this->AmadeusConfig->name.'</Name> 
               <System>'.$this->AmadeusConfig->system.'</System> 
               <Userid>'.$this->AmadeusConfig->userId.'</Userid> 
               <Password>'.$this->AmadeusConfig->password.'</Password> 
            </Provider>
         </TPA_Extensions>
      </POS>';
    }

    public function requestXML($body){
        return '
        <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
            <soap:Body>
                '.$body.'
            </soap:Body>
        </soap:Envelope>';
    }

    public function lowFarePlusRequestBodyXML($data){
        $passengers = '';
        if($data['num_of_adults'] > 0){
            $passengers = $passengers.'<PassengerTypeQuantity Code="ADT" Quantity="'.$data['num_of_adults'].'"/>';
        }if($data['num_of_children'] > 0){
            $passengers = $passengers.'<PassengerTypeQuantity Code="CHD" Quantity="'.$data['num_of_children'].'"/>';
        }if($data['num_of_infants'] > 0){
            $passengers = $passengers.'<PassengerTypeQuantity Code="INF" Quantity="'.$data['num_of_infants'].'"/>';
        }

        if($data['return_date'] == " " || $data['return_date'] == null){
            $originDestinations = '
                <OriginDestinationInformation>
                  <DepartureDateTime>'.date('Y-m-d',strtotime($data['departure_date'])).'T00:00:00</DepartureDateTime>   
                  <OriginLocation LocationCode="'.$this->AmadeusConfig::iataCode($data['departure_location']).'"/>   
                  <DestinationLocation LocationCode="'.$this->AmadeusConfig::iataCode($data['arrival_location']).'"/>  
                </OriginDestinationInformation> 
            ';
        }else{
            $originDestinations = '
                <OriginDestinationInformation>
                  <DepartureDateTime>'.date('Y-m-d',strtotime($data['departure_date'])).'T00:00:00</DepartureDateTime>   
                  <OriginLocation LocationCode="'.$this->AmadeusConfig::iataCode($data['departure_location']).'"/>   
                  <DestinationLocation LocationCode="'.$this->AmadeusConfig::iataCode($data['arrival_location']).'"/>  
                </OriginDestinationInformation> 
                <OriginDestinationInformation>
                  <DepartureDateTime>'.date('Y-m-d',strtotime($data['return_date'])).'T00:00:00</DepartureDateTime>
                  <OriginLocation LocationCode="'.$this->AmadeusConfig::iataCode($data['arrival_location']).'"/>   
                  <DestinationLocation LocationCode="'.$this->AmadeusConfig::iataCode($data['departure_location']).'"/>   
                </OriginDestinationInformation>
            ';
        }

       return '
              <OTA_AirLowFareSearchPlusRQ>   
                '.$this->posXML().'
                '.$originDestinations.'
                <TravelPreferences>
                  <CabinPref Cabin="'.$data['cabin'].'"/>
                </TravelPreferences> 
                <TravelerInfoSummary>   
                  <SeatsRequested>'.($data['num_of_adults'] + $data['num_of_children']).'</SeatsRequested>
                  <AirTravelerAvail>
                    '.$passengers.'
                  </AirTravelerAvail>  
                  <PriceRequestInformation PricingSource="Both"/>
                </TravelerInfoSummary>
              </OTA_AirLowFareSearchPlusRQ>';
    }

    public function lowFarePlusMultiDestinationRequestBodyXML($data){
        $passengers = '';
        if($data['num_of_adults'] > 0){
            $passengers = $passengers.'<PassengerTypeQuantity Code="ADT" Quantity="'.$data['num_of_adults'].'"/>';
        }if($data['num_of_children'] > 0){
            $passengers = $passengers.'<PassengerTypeQuantity Code="CHD" Quantity="'.$data['num_of_children'].'"/>';
        }if($data['num_of_infants'] > 0){
            $passengers = $passengers.'<PassengerTypeQuantity Code="INF" Quantity="'.$data['num_of_infants'].'"/>';
        }
        $originDestinations = '';
        foreach($data['originDestinations'] as $serial => $originDestination){
            $originDestinations = $originDestinations.'
            <OriginDestinationInformation>
                  <DepartureDateTime>'.date('Y-m-d',strtotime($originDestination['departure_date'])).'T00:00:00</DepartureDateTime>   
                  <OriginLocation LocationCode="'.$this->AmadeusConfig::iataCode($originDestination['departure_location']).'"/>   
                  <DestinationLocation LocationCode="'.$this->AmadeusConfig::iataCode($originDestination['arrival_location']).'"/>  
                </OriginDestinationInformation> 
            ';
        }
        return '
              <OTA_AirLowFareSearchPlusRQ>   
                '.$this->posXML().'
                '.$originDestinations.'
                <TravelPreferences>
                  <CabinPref Cabin="'.$data['cabin'].'"/>
                </TravelPreferences> 
                <TravelerInfoSummary>   
                  <SeatsRequested>'.($data['num_of_adults'] + $data['num_of_children']).'</SeatsRequested>
                  <AirTravelerAvail>
                    '.$passengers.'
                  </AirTravelerAvail>  
                  <PriceRequestInformation PricingSource="Both"/>
                </TravelerInfoSummary>
              </OTA_AirLowFareSearchPlusRQ>';
    }

    public function lowFareMatrixRequestBodyXML($data){
        $passengers = '';
        if($data['num_of_adults'] > 0){
            $passengers = $passengers.'<PassengerTypeQuantity Code="ADT" Quantity="'.$data['num_of_adults'].'"/>';
        }if($data['num_of_children'] > 0){
            $passengers = $passengers.'<PassengerTypeQuantity Code="CHD" Quantity="'.$data['num_of_children'].'"/>';
        }if($data['num_of_infants'] > 0){
            $passengers = $passengers.'<PassengerTypeQuantity Code="INF" Quantity="'.$data['num_of_infants'].'"/>';
        }
        $originDestinations = '';
        foreach($data['originDestinations'] as $serial => $originDestination){
            $originDestinations = $originDestinations.'
            <OriginDestinationInformation>
                  <DepartureDateTime>'.date('Y-m-d',strtotime($originDestination['departure_date'])).'T00:00:00</DepartureDateTime>   
                  <OriginLocation LocationCode="'.$this->AmadeusConfig::iataCode($originDestination['departure_location']).'"/>   
                  <DestinationLocation LocationCode="'.$this->AmadeusConfig::iataCode($originDestination['arrival_location']).'"/>  
                </OriginDestinationInformation> 
            ';
        }
        return '
              <OTA_AirLowFareSearchMatrixRQ>   
                '.$this->posXML().'
                '.$originDestinations.'
                <TravelPreferences>
                  <CabinPref Cabin="'.$data['cabin'].'"/>
                </TravelPreferences> 
                <TravelerInfoSummary>   
                  <SeatsRequested>'.($data['num_of_adults'] + $data['num_of_children']).'</SeatsRequested>
                  <AirTravelerAvail>
                    '.$passengers.'
                  </AirTravelerAvail>  
                  <PriceRequestInformation PricingSource="Both"/>
                </TravelerInfoSummary>
              </OTA_AirLowFareSearchMatrixRQ>';
    }

    public function lowFareScheduleRequestBodyXML($data){
        $passengers = '';
        if($data['num_of_adults'] > 0){
            $passengers = $passengers.'<PassengerTypeQuantity Code="ADT" Quantity="'.$data['num_of_adults'].'"/>';
        }if($data['num_of_children'] > 0){
            $passengers = $passengers.'<PassengerTypeQuantity Code="CHD" Quantity="'.$data['num_of_children'].'"/>';
        }if($data['num_of_infants'] > 0){
            $passengers = $passengers.'<PassengerTypeQuantity Code="INF" Quantity="'.$data['num_of_infants'].'"/>';
        }
        $originDestinations = '';
        foreach($data['originDestinations'] as $serial => $originDestination){
            $originDestinations = $originDestinations.'
            <OriginDestinationInformation>
                  <DepartureDateTime>'.date('Y-m-d',strtotime($originDestination['departure_date'])).'T00:00:00</DepartureDateTime>   
                  <OriginLocation LocationCode="'.$this->AmadeusConfig::iataCode($originDestination['departure_location']).'"/>   
                  <DestinationLocation LocationCode="'.$this->AmadeusConfig::iataCode($originDestination['arrival_location']).'"/>  
                </OriginDestinationInformation> 
            ';
        }
        return '
              <OTA_AirLowFareSearchScheduleRQ>   
                '.$this->posXML().'
                '.$originDestinations.'
                <TravelPreferences>
                  <CabinPref Cabin="'.$data['cabin'].'"/>
                </TravelPreferences> 
                <TravelerInfoSummary>   
                  <SeatsRequested>'.($data['num_of_adults'] + $data['num_of_children']).'</SeatsRequested>
                  <AirTravelerAvail>
                    '.$passengers.'
                  </AirTravelerAvail>  
                  <PriceRequestInformation PricingSource="Both"/>
                </TravelerInfoSummary>
              </OTA_AirLowFareSearchScheduleRQ>';
    }

    public function flightInfoRequestXML($data){
        return '
            <OTA_AirFlifoRQ Version="1.000">
              '.$this->posXML().'
                <Airline Code="'.$data['airline_code'].'" />  
                <FlightNumber>'.$data['flight_number'].'</FlightNumber>  
                <DepartureDate>'.$data['departure_date'].'</DepartureDate>  
                <DepartureAirport LocationCode="'.$data['departure_airport_code'].'" />  
                <ArrivalAirport LocationCode="'.$data['arrival_airport_code'].'" /> 
            </OTA_AirFlifoRQ>';
    }

    public function airSeatMapRequestXML($data){
        return '
              <OTA_AirSeatMapRQ>  
              '.$this->posXML().'
                <SeatMapRequests>   
                  <SeatMapRequest>    
                    <FlightSegmentInfo DepartureDateTime="'.$data['departure_date_time'].'2006-10-11" FlightNumber="'.$data['flight_number'].'">     
                      <DepartureAirport LocationCode="'.$data['departure_airport_code'].'"/>     
                      <ArrivalAirport LocationCode="'.$data['arrival_airport_code'].'"/>     
                      <MarketingAirline Code="'.$data['marketing_airline'].'"/>    
                    </FlightSegmentInfo>    
                    <SeatDetails>     
                      <CabinClass CabinType="'.$data['cabin_type'].'"/>     
                      <ResBookDesignations>      
                        <ResBookDesignation ResBookDesigCode="'.$data['res_book_desig_code'].'"/>     
                      </ResBookDesignations>    
                    </SeatDetails>   
                  </SeatMapRequest>  
                </SeatMapRequests> 
              </OTA_AirSeatMapRQ>';
    }









}