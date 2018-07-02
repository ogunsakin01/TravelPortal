<?php
/**
 * Created by PhpStorm.
 * User: UniQue
 * Date: 4/6/2018
 * Time: 1:09 PM
 */

namespace App\Services;


use App\Title;

class AmadeusRequestXML
{
    private $AmadeusConfig;

    private $PortalConfig;

    public function __construct(){

        $this->AmadeusConfig = new AmadeusConfig();
        $this->PortalConfig  = new PortalConfig();
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

    public function advancedRequestXML($body,$header){
        return'
        <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
            <soap:Header>
              '.$header.'
            </soap:Header>
            <soap:Body>
                '.$body.'
            </soap:Body>
        </soap:Envelope>';
    }

    public function lowFarePlusRequestBodyXML($data){
        $passengers = '';
        if($data->no_of_adult > 0){
            $passengers = $passengers.'<PassengerTypeQuantity Code="ADT" Quantity="'.$data->no_of_adult.'"/>';
        }if($data->no_of_child > 0){
            $passengers = $passengers.'<PassengerTypeQuantity Code="CHD" Quantity="'.$data->no_of_child.'"/>';
        }if($data->no_of_infant > 0){
            $passengers = $passengers.'<PassengerTypeQuantity Code="INF" Quantity="'.$data->no_of_infant.'"/>';
        }

        if($data->return_date == "" || $data->return_date == null ||  $data->return_date ==  "Not Available"){
            $originDestinations = '
                <OriginDestinationInformation>
                  <DepartureDateTime>'.date('Y-m-d',strtotime($data->departure_date)).'T00:00:00</DepartureDateTime>   
                  <OriginLocation LocationCode="'.$this->AmadeusConfig::iataCode($data->departure_city).'"/>   
                  <DestinationLocation LocationCode="'.$this->AmadeusConfig::iataCode($data->destination_city).'"/>  
                </OriginDestinationInformation> 
            ';
        }else{
            $originDestinations = '
                <OriginDestinationInformation>
                  <DepartureDateTime>'.date('Y-m-d',strtotime($data->departure_date)).'T00:00:00</DepartureDateTime>   
                  <OriginLocation LocationCode="'.$this->AmadeusConfig::iataCode($data->departure_city).'"/>   
                  <DestinationLocation LocationCode="'.$this->AmadeusConfig::iataCode($data->destination_city).'"/>  
                </OriginDestinationInformation> 
                <OriginDestinationInformation>
                  <DepartureDateTime>'.date('Y-m-d',strtotime($data->return_date)).'T00:00:00</DepartureDateTime>
                  <OriginLocation LocationCode="'.$this->AmadeusConfig::iataCode($data->destination_city).'"/>   
                  <DestinationLocation LocationCode="'.$this->AmadeusConfig::iataCode($data->departure_city).'"/>   
                </OriginDestinationInformation>
            ';
        }

        $body = '
            <wmLowFarePlus xmlns="http://traveltalk.com/wsLowFarePlus">
              <OTA_AirLowFareSearchPlusRQ>   
                '.$this->posXML().'
                '.$originDestinations.'
                <TravelPreferences>
                  <FareRestrictPref>
                      <AdvResTicketing>
                           
                           <AdvReservation/>   
                            </AdvResTicketing>    
                            <StayRestrictions>     
                            <MinimumStay/>     
                            <MaximumStay/>    
                            </StayRestrictions>    
                            <VoluntaryChanges>     
                            <Penalty/>    
                            </VoluntaryChanges>   
                            </FareRestrictPref>  
                </TravelPreferences> 
                <TravelerInfoSummary>   
                  <SeatsRequested>'.($data->no_of_adult + $data->no_of_child).'</SeatsRequested>
                  <AirTravelerAvail>
                    '.$passengers.'
                  </AirTravelerAvail>  
                  <PriceRequestInformation PricingSource="Both"/>
                </TravelerInfoSummary>
              </OTA_AirLowFareSearchPlusRQ>
            </wmLowFarePlus>';

        return $this->requestXML($body);
    }

    public function lowFarePlusMultiDestinationRequestBodyXML($data){
        $passengers = '';

        if($data['searchParam']['no_of_adult'] > 0){
            $passengers = $passengers.'<PassengerTypeQuantity Code="ADT" Quantity="'.$data['searchParam']['no_of_adult'].'"/>';
        }if($data['searchParam']['no_of_child'] > 0){
            $passengers = $passengers.'<PassengerTypeQuantity Code="CHD" Quantity="'.$data['searchParam']['no_of_child'].'"/>';
        }if($data['searchParam']['no_of_infant'] > 0){
            $passengers = $passengers.'<PassengerTypeQuantity Code="INF" Quantity="'.$data['searchParam']['no_of_infant'].'"/>';
        }
        $originDestinations = '';
        foreach($data['originDestinations']as $serial => $originDestination){
            $originDestinations = $originDestinations.'
            <OriginDestinationInformation>
                  <DepartureDateTime>'.date('Y-m-d',strtotime($originDestination['departure_date'])).'T00:00:00</DepartureDateTime>   
                  <OriginLocation LocationCode="'.$this->AmadeusConfig::iataCode($originDestination['departure_city']).'"/>   
                  <DestinationLocation LocationCode="'.$this->AmadeusConfig::iataCode($originDestination['destination_city']).'"/>  
                </OriginDestinationInformation> 
            ';
        }
        $body = '
            <wmLowFarePlus xmlns="http://traveltalk.com/wsLowFarePlus">
              <OTA_AirLowFareSearchPlusRQ>   
                '.$this->posXML().'
                '.$originDestinations.'
                <TravelPreferences>
                 <FareRestrictPref>
                      <AdvResTicketing>
                           <AdvReservation/>   
                            </AdvResTicketing>    
                            <StayRestrictions>     
                            <MinimumStay/>     
                            <MaximumStay/>    
                            </StayRestrictions>    
                            <VoluntaryChanges>     
                            <Penalty/>    
                            </VoluntaryChanges>   
                            </FareRestrictPref> 
                </TravelPreferences> 
                <TravelerInfoSummary>   
                  <SeatsRequested>'.($data->searchParam['no_of_adult'] + $data->searchParam['no_of_child']).'</SeatsRequested>
                  <AirTravelerAvail>
                    '.$passengers.'
                  </AirTravelerAvail>  
                  <PriceRequestInformation PricingSource="Both"/>
                </TravelerInfoSummary>
              </OTA_AirLowFareSearchPlusRQ>
            </wmLowFarePlus>';

        return $this->requestXML($body);
    }

    public function lowFareMatrixRequestBodyXML($data){
        $passengers = '';
        if($data['no_of_adult'] > 0){
            $passengers = $passengers.'<PassengerTypeQuantity Code="ADT" Quantity="'.$data['no_of_adult'].'"/>';
        }if($data['no_of_child'] > 0){
            $passengers = $passengers.'<PassengerTypeQuantity Code="CHD" Quantity="'.$data['no_of_child'].'"/>';
        }if($data['no_of_infant'] > 0){
            $passengers = $passengers.'<PassengerTypeQuantity Code="INF" Quantity="'.$data['no_of_infant'].'"/>';
        }
        $originDestinations = '';
        foreach($data['originDestinations'] as $serial => $originDestination){
            $originDestinations = $originDestinations.'
            <OriginDestinationInformation>
                  <DepartureDateTime>'.date('Y-m-d',strtotime($originDestination['departure_date'])).'T00:00:00</DepartureDateTime>   
                  <OriginLocation LocationCode="'.$this->AmadeusConfig::iataCode($originDestination['departure_city']).'"/>   
                  <DestinationLocation LocationCode="'.$this->AmadeusConfig::iataCode($originDestination['destination_city']).'"/>  
                </OriginDestinationInformation> 
            ';
        }
        $body = '
              <OTA_AirLowFareSearchMatrixRQ>   
                '.$this->posXML().'
                '.$originDestinations.'
                <TravelPreferences>
                  <FareRestrictPref>
                      <AdvResTicketing>
                           <AdvReservation/>   
                            </AdvResTicketing>    
                            <StayRestrictions>     
                            <MinimumStay/>     
                            <MaximumStay/>    
                            </StayRestrictions>    
                            <VoluntaryChanges>     
                            <Penalty/>    
                            </VoluntaryChanges>   
                            </FareRestrictPref> 
                </TravelPreferences> 
                <TravelerInfoSummary>   
                  <SeatsRequested>'.($data['no_of_adult'] + $data['no_of_child']).'</SeatsRequested>
                  <AirTravelerAvail>
                    '.$passengers.'
                  </AirTravelerAvail>  
                  <PriceRequestInformation PricingSource="Both"/>
                </TravelerInfoSummary>
              </OTA_AirLowFareSearchMatrixRQ>';

        return $this->requestXML($body);
    }

    public function lowFareScheduleRequestBodyXML($data){
        $passengers = '';
        if($data['no_of_adult'] > 0){
            $passengers = $passengers.'<PassengerTypeQuantity Code="ADT" Quantity="'.$data['no_of_adult'].'"/>';
        }if($data['no_of_child'] > 0){
            $passengers = $passengers.'<PassengerTypeQuantity Code="CHD" Quantity="'.$data['no_of_child'].'"/>';
        }if($data['no_of_infant'] > 0){
            $passengers = $passengers.'<PassengerTypeQuantity Code="INF" Quantity="'.$data['no_of_infant'].'"/>';
        }
        $originDestinations = '';
        foreach($data['originDestinations'] as $serial => $originDestination){
            $originDestinations = $originDestinations.'
            <OriginDestinationInformation>
                  <DepartureDateTime>'.date('Y-m-d',strtotime($originDestination['departure_date'])).'T00:00:00</DepartureDateTime>   
                  <OriginLocation LocationCode="'.$this->AmadeusConfig::iataCode($originDestination['departure_city']).'"/>   
                  <DestinationLocation LocationCode="'.$this->AmadeusConfig::iataCode($originDestination['destination_city']).'"/>  
                </OriginDestinationInformation> 
            ';
        }
        $body = '
              <OTA_AirLowFareSearchScheduleRQ>   
                '.$this->posXML().'
                '.$originDestinations.'
                <TravelPreferences>
                  <CabinPref Cabin="'.$data['cabin'].'"/>
                </TravelPreferences> 
                <TravelerInfoSummary>   
                  <SeatsRequested>'.($data['num_of_adult'] + $data['num_of_child']).'</SeatsRequested>
                  <AirTravelerAvail>
                    '.$passengers.'
                  </AirTravelerAvail>  
                  <PriceRequestInformation PricingSource="Both"/>
                </TravelerInfoSummary>
              </OTA_AirLowFareSearchScheduleRQ>';

        return $this->requestXML($body);
    }

    public function flightInfoRequestXML($data){
        $body = '
        <wmAirFlifoXml xmlns="http://traveltalk.com/wsAirFlifo">
            <OTA_AirFlifoRQ Version="1.000">
              '.$this->posXML().'
                <Airline Code="'.$data['filingAirlineCode'].'" />  
                <FlightNumber>'.$data['flightNumber'].'</FlightNumber>  
                <DepartureDate>'.$data['departureDateTime'].'</DepartureDate>  
                <DepartureAirport LocationCode="'.$data['departureAirportCode'].'" />  
                <ArrivalAirport LocationCode="'.$data['arrivalAirportCode'].'" /> 
            </OTA_AirFlifoRQ>
         </wmAirFlifoXml>';

        return $this->requestXML($body);
    }

    public function airSeatMapRequestXML($data){
        $body = '
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
        return $this->requestXML($body);
    }

    public function airPriceRequestXML($selectedItinerary, $searchParam){

//        dd($selectedItinerary);

        $passengers = '';

        if($searchParam['no_of_adult'] > 0){
            $passengers = $passengers.'<PassengerTypeQuantity Code="ADT" Quantity="'.$searchParam['no_of_adult'].'"/>';
        }

        if($searchParam['no_of_child'] > 0){
            $passengers = $passengers.'<PassengerTypeQuantity Code="CHD" Quantity="'.$searchParam['no_of_child'].'"/>';
        }

        if($searchParam['no_of_infant'] > 0){
            $passengers = $passengers.'<PassengerTypeQuantity Code="INF" Quantity="'.$searchParam['no_of_infant'].'"/>';
        }

        $seats = $searchParam['no_of_adult'] + $searchParam['no_of_child'];

        $originDestinationsCount = $selectedItinerary['originDestinationsCount'];

        if($originDestinationsCount > 1){
            $originDestinationOptions = '';
            for($i = 0; $i < $originDestinationsCount; $i++){
                $segmentInfo = '';
                $check = $i + 1;
                foreach($selectedItinerary['originDestinations'] as $serial => $originDestination){
                    $originDestination = (array)$originDestination;
                    if($check == $originDestination['originDestinationPlacement']){
                        $segmentInfoData = '<FlightSegment DepartureDateTime="'.$originDestination['departureDateTime'].'" ArrivalDateTime="'.$originDestination['arrivalDateTime'].'" FlightNumber="'.$originDestination['flightNumber'].'" ResBookDesigCode="'.$originDestination['resBookDesigCode'].'">    
		  <DepartureAirport LocationCode="'.$originDestination['departureAirportCode'].'"/>
		  <ArrivalAirport LocationCode="'.$originDestination['arrivalAirportCode'].'"/>      
		  <MarketingAirline Code="'.$originDestination['marketingAirlineCode'].'"/>     
		  </FlightSegment>';
                        $segmentInfo = $segmentInfo.$segmentInfoData;
                    }
                }
                $originDestinationOption = '';

                if($segmentInfo != ""){
                    $originDestinationOption = '<OriginDestinationOption>'.$segmentInfo.'</OriginDestinationOption>';
                }
                $originDestinationOptions = $originDestinationOptions.$originDestinationOption;
            }
        }

        else{
            $originDestinationOptions = '';
            $segmentInfo = '';
            foreach($selectedItinerary['originDestinations'] as $serial => $originDestination){

                $originDestination = (array)$originDestination;
                $segmentInfoData = '<FlightSegment DepartureDateTime="'.$originDestination['departureDateTime'].'" ArrivalDateTime="'.$originDestination['arrivalDateTime'].'" FlightNumber="'.$originDestination['flightNumber'].'" ResBookDesigCode="'.$originDestination['resBookDesigCode'].'">    
		  <DepartureAirport LocationCode="'.$originDestination['departureAirportCode'].'"/>
		  <ArrivalAirport LocationCode="'.$originDestination['arrivalAirportCode'].'"/>      
		  <MarketingAirline Code="'.$originDestination['marketingAirlineCode'].'"/>     
		  </FlightSegment>';
                $segmentInfo = $segmentInfo.$segmentInfoData;
            }
            $originDestinationOptions = '<OriginDestinationOption>'.$segmentInfo.'</OriginDestinationOption>';
        }

        $body = '
       <wmAirPrice xmlns="http://traveltalk.com/wsAirPrice">
		 <OTA_AirPriceRQ>
		  '.$this->posXML().' 
		  <AirItinerary>   
		  <OriginDestinationOptions>    
		  '.$originDestinationOptions.'  
		  </OriginDestinationOptions>  
		  </AirItinerary>  
		  <TravelerInfoSummary>   
		  <SeatsRequested>'.$seats.'</SeatsRequested>   
		  <AirTravelerAvail>    
		  '.$passengers.' 
		  </AirTravelerAvail>   
		  <PriceRequestInformation PricingSource="'.$selectedItinerary['pricingSource'].'"/>  
		  </TravelerInfoSummary> 
		 </OTA_AirPriceRQ>
		</wmAirPrice> ';

        return $this->requestXML($body);
    }

    public function buildTypeSort($buildType,$buildData){
        if($buildType == 'Hotel'){
            return $this->hotelBookXML($buildData);
        }elseif($buildType == 'Air'){
            return $this->airBookXML($buildData);
        }elseif($buildType == 'Vehicle'){
            return $this->vehicleBookXML($buildData);
        }
        return '';
    }

    public function airBookXML($selectedItinerary){
        $passengerCount = 0;
        foreach($selectedItinerary['itineraryPassengerInfo'] as $i => $count){
            if(!is_array($count)){
                $count = (array) $count;
            }
            if($count['passengerType'] != "INF"){
                $passengerCount = $passengerCount + $count['quantity'];
            }
        }


        $originDestinationsCount = $selectedItinerary['originDestinationsCount'];

        if($originDestinationsCount > 1){
            $originDestinationOptions = '';
            $segmentCount = 1;
            for($i = 0; $i < $originDestinationsCount; $i++){
                $segmentInfo = '';
                $check = $i + 1;
                foreach($selectedItinerary['originDestinations'] as $serial => $originDestination){
                    $originDestination = (array)$originDestination;
                    if($check == $originDestination['originDestinationPlacement']){
                        $segmentInfoData = '<FlightSegment DepartureDateTime="'.$originDestination['departureDateTime'].'" ArrivalDateTime="'.$originDestination['arrivalDateTime'].'" FlightNumber="'.$originDestination['flightNumber'].'" ResBookDesigCode="'.$originDestination['resBookDesigCode'].'" RPH="'.$segmentCount.'" NumberInParty="'.$passengerCount.'">    
		  <DepartureAirport LocationCode="'.$originDestination['departureAirportCode'].'"/>
		  <ArrivalAirport LocationCode="'.$originDestination['arrivalAirportCode'].'"/>      
		  <MarketingAirline Code="'.$originDestination['marketingAirlineCode'].'"/>     
		  </FlightSegment>';
                        $segmentInfo = $segmentInfo.$segmentInfoData;
                        $segmentCount = $segmentCount + 1;
                    }
                }

                $originDestinationOption = '';
                if($segmentInfo != ""){
                    $originDestinationOption = '<OriginDestinationOption>'.$segmentInfo.'</OriginDestinationOption>';
                }
                $originDestinationOptions = $originDestinationOptions.$originDestinationOption;
            }

        }

        else{
            $originDestinationOptions = '';
            $segmentInfo = '';
            $segmentCount = 1;
            foreach($selectedItinerary['originDestinations'] as $serial => $originDestination){
                $originDestination = (array)$originDestination;
                $segmentInfoData = '<FlightSegment DepartureDateTime="'.$originDestination['departureDateTime'].'" ArrivalDateTime="'.$originDestination['arrivalDateTime'].'" FlightNumber="'.$originDestination['flightNumber'].'" ResBookDesigCode="'.$originDestination['resBookDesigCode'].'" RPH="'.$segmentCount.'" NumberInParty="'.$passengerCount.'">    
		  <DepartureAirport LocationCode="'.$originDestination['departureAirportCode'].'"/>
		  <ArrivalAirport LocationCode="'.$originDestination['arrivalAirportCode'].'"/>      
		  <MarketingAirline Code="'.$originDestination['marketingAirlineCode'].'"/>     
		  </FlightSegment>';
                $segmentInfo = $segmentInfo.$segmentInfoData;
                $segmentCount = $segmentCount + 1;
            }
            $originDestinationOptions = '<OriginDestinationOption>'.$segmentInfo.'</OriginDestinationOption>';
        }

        return '
             <OTA_AirBookRQ>
   <AirItinerary DirectionInd="'.$selectedItinerary['directionInd'].'">
      <OriginDestinationOptions>
         '.$originDestinationOptions.'
      </OriginDestinationOptions>
   </AirItinerary>
</OTA_AirBookRQ>
           ';

    }

    public function hotelBookXML($hotelRoomInformation){
        return '<OTA_HotelResRQ>
   <HotelReservations>
      <HotelReservation RoomStayReservation="1">
         <RoomStays>
            <RoomStay SourceOfBusiness="I">
               <RoomRates>
                  <RoomRate BookingCode="ROHPRO" NumberOfUnits="1" RatePlanCode="PRO" />
               </RoomRates>
               <GuestCounts>
                  <GuestCount AgeQualifyingCode="ADT" Age="0" Count="1" />
               </GuestCounts>
               <TimeSpan Start="2006-09-07" Duration="7" End="2006-09-14" />
               <Guarantee GuaranteeType="CC">
                  <GuaranteesAccepted>
                     <GuaranteeAccepted>
                        <PaymentCard CardType="Credit" CardCode="VI" CardNumber="4444333322221111" ExpireDate="0506">
                           <CardHolderName>JOHN SMITH</CardHolderName>
                           <Address FormattedInd="0" Type="Home">
                              <StreetNmbr>7300 NORTH KENDALL DRIVE</StreetNmbr>
                              <CityName>MIAMI</CityName>
                              <PostalCode>33156</PostalCode>
                              <StateProv>FL</StateProv>
                              <CountryName>USA</CountryName>
                           </Address>
                        </PaymentCard>
                     </GuaranteeAccepted>
                  </GuaranteesAccepted>
               </Guarantee>
               <DepositPayments>
                  <RequiredPayment>
                     <AcceptedPayments>
                        <AcceptedPayment>
                           <PaymentCard CardType="Credit" CardCode="VI" CardNumber="4444333322221111" ExpireDate="0506">
                              <CardHolderName>JOHN SMITH</CardHolderName>
                              <Address FormattedInd="0" Type="Home">
                                 <StreetNmbr>7300 NORTH KENDALL DRIVE</StreetNmbr>
                                 <CityName>MIAMI</CityName>
                                 <PostalCode>33156</PostalCode>
                                 <StateProv>FL</StateProv>
                                 <CountryName>USA</CountryName>
                              </Address>
                           </PaymentCard>
                        </AcceptedPayment>
                     </AcceptedPayments>
                  </RequiredPayment>
               </DepositPayments>
               <BasicPropertyInfo ChainCode="BR" HotelCode="SCB" HotelCityCode="SFO" HotelCodeContext="DY" />
               <ResGuestRPHs>
                  <ResGuestRPH RPH="1" />
               </ResGuestRPHs>
               <SpecialRequests>
                  <SpecialRequest RequestCode="SI">
                     <Text>Supplental Information</Text>
                  </SpecialRequest>
                  <SpecialRequest RequestCode="TN">
                     <Text>TN12345</Text>
                  </SpecialRequest>
               </SpecialRequests>
            </RoomStay>
         </RoomStays>
      </HotelReservation>
   </HotelReservations>
</OTA_HotelResRQ>';
    }

    public function vehicleBookXML($vehicleInformation){
        return '<?xml version="1.0" encoding="UTF-8"?>
<OTA_VehResRQ>
   <VehResRQCore Status="Available">
      <VehRentalCore PickUpDateTime="2006-07-05T06:00:00" ReturnDateTime="2006-08-04T06:00:00">
         <PickUpLocation LocationCode="NCE" />
         <ReturnLocation LocationCode="NCE" />
      </VehRentalCore>
      <VendorPref Code="EP" CodeContext="CP" />
      <VehPref>
         <VehType VehicleCategory="EBMN" />
      </VehPref>
      <RateQualifier RateQualifier="EUPR" />
      <TPA_Extensions>
         <CarData NumCars="1">
            <CarRate Rate="63301" Currency="USD" />
         </CarData>
      </TPA_Extensions>
   </VehResRQCore>
</OTA_VehResRQ>';
    }

    public function hotelDepositXML(){
        return '<DepositPayments>
                   <RequiredPayment>
                   <AcceptedPayments>
                   <AcceptedPayment>
                   <PaymentCard CardType="Credit" CardCode="VI" CardNumber="4444333322221111" ExpireDate="0520">
                   <CardHolderName>JOHN SMITH</CardHolderName>
                   <Address FormattedInd="0" Type="Home">
                   <StreetNmbr>7300 NORTH KENDALL DRIVE</StreetNmbr>
                   <CityName>MIAMI</CityName>
                   <PostalCode>33156</PostalCode>
                   <StateProv>FL</StateProv>
                   <CountryName>USA</CountryName>
                   </Address>
                   </PaymentCard>
                   </AcceptedPayment>
                   </AcceptedPayments>
                   </RequiredPayment>
                   </DepositPayments>';
    }

    public function hotelGuaranteeXML(){
        return '<Guarantee GuaranteeType="CC">
                   <GuaranteesAccepted>
                   <GuaranteeAccepted>
                   <PaymentCard CardType="Credit" CardCode="VI" CardNumber="4444333322221111" ExpireDate="0520">
                   <CardHolderName>JOHN SMITH</CardHolderName>
                   <Address FormattedInd="0" Type="Home">
                   <StreetNmbr>7300 NORTH KENDALL DRIVE</StreetNmbr>
                   <CityName>MIAMI</CityName>
                   <PostalCode>33156</PostalCode>
                   <StateProv>FL</StateProv>
                   <CountryName>USA</CountryName>
                   </Address>
                   </PaymentCard>
                   </GuaranteeAccepted>
                   </GuaranteesAccepted>
                   </Guarantee>';
    }

    public function flightTravelBuildRequestElementXML($passengerInformation,$buildData,$user){

        $body = '
  <wmTravelBuild xmlns="http://traveltalk.com/wsTravelBuild">
  <OTA_TravelItineraryRQ>
   '.$this->posXML().'
   '.$this->airBookXML($buildData).'
   <TPA_Extensions>
      <PNRData>
      '.$this->airBookPassengersXML($passengerInformation).'
         <Telephone PhoneLocationType="Home" CountryAccessCode="234" AreaCityCode="LOS" PhoneNumber="'.$user['profile']['phone_number'].'" FormattedInd="0"/>
         <Email>'.$user['email'].'</Email>
         <Ticketing TicketTimeLimit="'.$buildData['ticketTimeLimit'].'" TicketType="eTicket" />
      </PNRData>
      <PriceData PriceType="'.$buildData['pricingSource'].'" AutoTicketing="false" ValidatingAirlineCode="'.$buildData['validatingAirlineCode'].'" >
       <PublishedFares>
      <FareRestrictPref>
      <AdvResTicketing><AdvReservation/>
      </AdvResTicketing>
      <StayRestrictions>
      <MinimumStay/>
      <MaximumStay/>
      </StayRestrictions>
      <VoluntaryChanges>
      <Penalty/>
      </VoluntaryChanges>
      </FareRestrictPref>
      </PublishedFares>
      </PriceData>
   </TPA_Extensions>
  </OTA_TravelItineraryRQ>
  </wmTravelBuild>';

        return $this->requestXML($body);
    }

    public function hotelTravelBuildRequestElementXML($selectedRoom,$selectedHotel,$searchParam,$bookingCustomer){
        $guests = '';
        if($searchParam['child_count'] > 0){
            $guests = $guests.'<GuestCount AgeQualifyingCode="ADT" Age="0" Count="'.$searchParam['child_count'].'"></GuestCount>';
        }if ($searchParam['adult_count'] > 0){
            $guests = $guests.'<GuestCount AgeQualifyingCode="ADT" Age="0" Count="'.$searchParam['adult_count'].'"></GuestCount>';
        }
        $duration = floor(strtotime($searchParam['check_out_date']) - strtotime($searchParam['check_in_date']) / (60 * 60 * 24));

        if($selectedRoom['guarantee'] == 'GuaranteeRequired'){
            $guarantee = $this->hotelGuaranteeXML();
        }elseif($selectedRoom['guarantee'] == 'Deposit'){
            $guarantee = $this->hotelDepositXML();
        }else{
            $guarantee = $this->hotelDepositXML();
        }

        $body = '<wmTravelBuild xmlns="http://traveltalk.com/wsTravelBuild">
       <OTA_TravelItineraryRQ>
      '.$this->posXML().'
       <OTA_HotelResRQ>
       <HotelReservations>
        <HotelReservation RoomStayReservation="1">
            <RoomStays>
              <RoomStay>
                  <RoomRates>
                    <RoomRate BookingCode="'.$selectedRoom['bookingCode'].'" NumberOfUnits="1" RatePlanCode="'.$selectedRoom['ratePlanCode'].'">
                     </RoomRate>
                    </RoomRates>
                   <GuestCounts>
                    '.$guests.'
                    </GuestCounts>
                    <TimeSpan Start="'.date('Y-m-d', strtotime($searchParam['check_in_date'])).'" Duration="'.$duration.'" End="'.date('Y-m-d', strtotime($searchParam['check_out_date'])).'">
                            </TimeSpan>
                            '.$guarantee.'                 
                 <BasicPropertyInfo ChainCode="'.$selectedHotel['chainCode'].'" HotelCode="'.$selectedHotel['hotelCode'].'" HotelCityCode="'.$selectedHotel['hotelCityCode'].'" HotelCodeContext="'.$selectedHotel['hotelContextCode'].'">
                   </BasicPropertyInfo>
                  </RoomStay>
                 </RoomStays>
                 </HotelReservation>
                 </HotelReservations>
                 </OTA_HotelResRQ> 
                <TPA_Extensions>
                <PNRData>
                  <Traveler>
                   <PersonName>
                    <NamePrefix>'.Title::find($bookingCustomer['title_id'])->name.'</NamePrefix>                    
                    <GivenName>'.$bookingCustomer['first_name'].' '.$bookingCustomer['other_name'].'</GivenName>
                    <Surname>'.$bookingCustomer['sur_name'].'</Surname>
                   </PersonName>
                   <TravelerRefNumber RPH="1"/>
                  </Traveler>
                  <Telephone PhoneLocationType="Home" CountryAccessCode="234"  FormattedInd="0" AreaCityCode="LOS" PhoneNumber="'.$bookingCustomer['phone'].'"/>
                  <Email>'.$bookingCustomer['email'].'</Email>
                  <Ticketing>
                  <TicketAdvisory>OK</TicketAdvisory>
                  </Ticketing>
                 </PNRData></TPA_Extensions>
                 </OTA_TravelItineraryRQ>
        </wmTravelBuild>';

        return $this->requestXML($body);
    }

    public function hotelTravelBuildRebookRequestElementXML($bookingInformation,$user){
        $guests = '';
        if($bookingInformation->child_guest > 0){
            $guests = $guests.'<GuestCount AgeQualifyingCode="ADT" Age="0" Count="'.$bookingInformation->child_guest.'"></GuestCount>';
        }if ($bookingInformation->adult_guest > 0){
            $guests = $guests.'<GuestCount AgeQualifyingCode="ADT" Age="0" Count="'.$bookingInformation->adult_guest.'"></GuestCount>';
        }
        $duration = floor(strtotime($bookingInformation->check_out_date) - strtotime($bookingInformation->check_in_date) / (60 * 60 * 24));

        if($bookingInformation->guarantee == 'GuaranteeRequired'){
            $guarantee = $this->hotelGuaranteeXML();
        }elseif($bookingInformation->guarantee == 'Deposit'){
            $guarantee = $this->hotelDepositXML();
        }else{
            $guarantee = $this->hotelDepositXML();
        }

        $body = '<wmTravelBuild xmlns="http://traveltalk.com/wsTravelBuild">
       <OTA_TravelItineraryRQ>
      '.$this->posXML().'
       <OTA_HotelResRQ>
       <HotelReservations>
        <HotelReservation RoomStayReservation="1">
            <RoomStays>
              <RoomStay>
                  <RoomRates>
                    <RoomRate BookingCode="'.$bookingInformation->room_booking_code.'" NumberOfUnits="1" RatePlanCode="'.$bookingInformation->ratePlanCode.'">
                     </RoomRate>
                    </RoomRates>
                   <GuestCounts>
                    '.$guests.'
                    </GuestCounts>
                    <TimeSpan Start="'.date('Y-m-d', strtotime($bookingInformation->check_in_date)).'" Duration="'.$duration.'" End="'.date('Y-m-d', strtotime($bookingInformation->check_out_date)).'">
                    </TimeSpan>
                    '.$guarantee.'                 
                 <BasicPropertyInfo ChainCode="'.$bookingInformation->hotel_chain_code.'" HotelCode="'.$bookingInformation->hotel_code.'" HotelCityCode="'.$bookingInformation->hotel_city_code.'" HotelCodeContext="'.$bookingInformation->hotel_context_code.'">
                   </BasicPropertyInfo>
                  </RoomStay>
                 </RoomStays>
                 </HotelReservation>
                 </HotelReservations>
                 </OTA_HotelResRQ> 
                <TPA_Extensions>
                <PNRData>
                  <Traveler>
                   <PersonName>
                    <NamePrefix>'.Title::find($user->title_id)->name.'</NamePrefix>                    
                    <GivenName>'.$user->first_name.' '.$user->other_name.'</GivenName>
                    <Surname>'.$user->sur_name.'</Surname>
                   </PersonName>
                   <TravelerRefNumber RPH="1"/>
                  </Traveler>
                  <Telephone PhoneLocationType="Home" CountryAccessCode="234"  FormattedInd="0" AreaCityCode="LOS" PhoneNumber="'.$user->phone_number.'"/>
                  <Email>'.$user->email.'</Email>
                  <Ticketing>
                  <TicketAdvisory>OK</TicketAdvisory>
                  </Ticketing>
                 </PNRData></TPA_Extensions>
                 </OTA_TravelItineraryRQ>
        </wmTravelBuild>';

        return $this->requestXML($body);
    }

    public function airBookPassengersXML($passengerInformation){
        $available = [];
        foreach($passengerInformation as $key => $information){
            $prefix = explode('_',$key)[0];
            if($prefix != ""){
                array_push($available,$prefix);
            }
        }
        $passengerArray = array_values(array_unique($available));
        $passengerRPH = 1;
        $travelers = '';
        foreach($passengerArray as $serial => $passengerType){
            $passengerTypeCount = count($passengerInformation[$passengerType."_title"]);
            for($p = 0; $p < $passengerTypeCount; $p++){
                $addition = '';
                if($passengerType != 'adult'){
                    $dob_new = $passengerInformation[$passengerType."_year_of_birth"][$p].'-'.$passengerInformation[$passengerType."_month_of_birth"][$p].'-'.$passengerInformation[$passengerType."_day_of_birth"][$p];
                    $date = $dob = date('Y-m-d', strtotime($dob_new));
                    $birthDate = 'BirthDate="'.$date.'"';
                    if($passengerType == 'infant'){
                        $passengerTypeCode = 'PassengerTypeCode="INF"';
                    }elseif($passengerType == 'child'){
                        $passengerTypeCode = 'PassengerTypeCode="CHD"';
                    }
                    $addition = ' '.$passengerTypeCode.' '.$birthDate;
                }
                $traveler = '
                <Traveler'.$addition.'>
                  <PersonName>
                    <NamePrefix>'.$passengerInformation[$passengerType."_title"][$p].'</NamePrefix>
                    <GivenName>'.$passengerInformation[$passengerType."_given_name"][$p].'</GivenName>
                    <Surname>'.$passengerInformation[$passengerType."_sur_name"][$p].'</Surname>
                  </PersonName>
                  <TravelerRefNumber RPH="'.$passengerRPH.'" />
                </Traveler>
                ';
                $passengerRPH =  $passengerRPH + 1;
                $travelers = $travelers.$traveler;
            }
        }

        return $travelers;
    }

    public function hotelAvailRequestXml($data){
        $body = '
<wmHotelAvail xmlns="http://traveltalk.com/wsHotelAvail">
<OTA_HotelAvailRQ>
     '.$this->posXML().'
   <AvailRequestSegments>
      <AvailRequestSegment>
         <StayDateRange Start="'.date('Y-m-d',strtotime($data['check_in_date'])).'" End="'.date('Y-m-d',strtotime($data['check_out_date'])).'" />
         <RoomStayCandidates>
            <RoomStayCandidate>
               <GuestCounts IsPerRoom="true">
                  <GuestCount Count="'. ($data['adult_count'] + $data['child_count']) .'" />
               </GuestCounts>
            </RoomStayCandidate>
         </RoomStayCandidates>
         <HotelSearchCriteria>
            <Criterion ExactMatch="true">
               <HotelRef HotelCityCode="'.$this->AmadeusConfig::iataCode($data['hotel_city']).'" />
            </Criterion>
         </HotelSearchCriteria>
      </AvailRequestSegment>
   </AvailRequestSegments>
</OTA_HotelAvailRQ>
</wmHotelAvail>';
        return $this->requestXML($body);
    }

    public function hotelAvailRoomRequestXML($searchParam,$selectedHotel){
        $body = '
<wmHotelAvail xmlns="http://traveltalk.com/wsHotelAvail">
<OTA_HotelAvailRQ>
     '.$this->posXML().'
   <AvailRequestSegments>
      <AvailRequestSegment>
         <StayDateRange Start="'.date('Y-m-d',strtotime($searchParam['check_in_date'])).'" End="'.date('Y-m-d',strtotime($searchParam['check_out_date'])).'" />
         <RoomStayCandidates>
            <RoomStayCandidate>
               <GuestCounts IsPerRoom="true">
                  <GuestCount Count="'. ($searchParam['adult_count'] + $searchParam['child_count']) .'" />
               </GuestCounts>
            </RoomStayCandidate>
         </RoomStayCandidates>
         <HotelSearchCriteria>
            <Criterion ExactMatch="true">
               <HotelRef ChainCode="'.$selectedHotel['chainCode'].'" HotelCode="'.$selectedHotel['hotelCode'].'" HotelCityCode="'.$this->AmadeusConfig::iataCode($searchParam['hotel_city']).'" />
            </Criterion>
         </HotelSearchCriteria>
      </AvailRequestSegment>
   </AvailRequestSegments>
</OTA_HotelAvailRQ>
</wmHotelAvail>';

        return $this->requestXML($body);
    }

    public function hotelAvailRoomDetailsRequestXML($roomInfo,$hotelInfo,$searchParam){
        $body = '
<wmHotelAvail xmlns="http://traveltalk.com/wsHotelAvail">
<OTA_HotelAvailRQ>
     '.$this->posXML().'
   <AvailRequestSegments>
      <AvailRequestSegment>
         <StayDateRange Start="'.date('Y-m-d',strtotime($searchParam['check_in_date'])).'" End="'.date('Y-m-d',strtotime($searchParam['check_out_date'])).'" />
         <RoomStayCandidates>
            <RoomStayCandidate>
               <GuestCounts IsPerRoom="1">
                  <GuestCount Count="'. ($searchParam['adult_count'] + $searchParam['child_count']) .'" />
               </GuestCounts>
            </RoomStayCandidate>
         </RoomStayCandidates>
         <HotelSearchCriteria>
            <Criterion ExactMatch="1">
               <HotelRef ChainCode="'.$hotelInfo['chainCode'].'" HotelCode="'.$hotelInfo['hotelCode'].'" HotelCityCode="'.$this->AmadeusConfig::iataCode($searchParam['hotel_city']).'"  />
            </Criterion>
         </HotelSearchCriteria>
         <RatePlanCandidates>
            <RatePlanCandidate RatePlanID="'.$roomInfo['bookingCode'].'"/>    
          </RatePlanCandidates> 
      </AvailRequestSegment>
   </AvailRequestSegments>
</OTA_HotelAvailRQ>
</wmHotelAvail>';
        return $this->requestXML($body);
    }

    public function cancelPNRRequestXML($pnr){
        $body = '<wmPNRCancel xmlns="http://traveltalk.com/wsPNRCancel">
                    <OTA_CancelRQ>
                      '.$this->posXML().'
                      <UniqueID ID="'.$pnr.'"/>
                    </OTA_CancelRQ>
                   </wmPNRCancel> ';

        $header = '<TripXML xmlns="http://amadeusws.tripxml.com/TripXML/wsPNRCancel.asmx">
              <userName>string</userName>
              <password>string</password>
              <compressed>boolean</compressed>
            </TripXML>';

        return $this->advancedRequestXML($body,$header);
    }

    public function voidTicket($ticketNumber){

        $body = '<wmVoidTicket xmlns="http://traveltalk.com/wsVoidTicket">
                  <TT_VoidTicketRQ Version="1.0">
                   '.$this->posXML().'
                   <Tickets>
                    <TicketNumber>'.$ticketNumber.'</TicketNumber>
                   </Tickets>
                  </TT_VoidTicketRQ>
                 </wmVoidTicket>';

        $header = '<TripXML xmlns="http://amadeusws.tripxml.com/TripXML/wsVoidTicket.asmx">
              <userName>string</userName>
              <password>string</password>
              <compressed>boolean</compressed>
            </TripXML>';

        return $this->advancedRequestXML($body,$header);
    }

    public function issueTicket($pnr){

        $body = '<wmIssueTicket xmlns="http://traveltalk.com/wsIssueTicket">
                   <TT_IssueTicketRQ>
                     '.$this->posXML().'
                     <UniqueID ID="'.$pnr.'"/>
                     <Ticketing TicketType="eTicket"/>
                   </TT_IssueTicketRQ>
                 </wmIssueTicket>';

        $header = '<TripXML xmlns="http://amadeusws.tripxml.com/TripXML/wsIssueTicket.asmx">
              <userName>string</userName>
              <password>string</password>
              <compressed>boolean</compressed>
            </TripXML>';

        return $this->advancedRequestXML($body,$header);

    }
}