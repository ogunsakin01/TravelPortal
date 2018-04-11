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

    public function lowFarePlusRequestBodyXML($data){
        $passengers = '';
        if($data['no_of_adult'] > 0){
            $passengers = $passengers.'<PassengerTypeQuantity Code="ADT" Quantity="'.$data['no_of_adult'].'"/>';
        }if($data['no_of_child'] > 0){
            $passengers = $passengers.'<PassengerTypeQuantity Code="CHD" Quantity="'.$data['no_of_child'].'"/>';
        }if($data['no_of_infant'] > 0){
            $passengers = $passengers.'<PassengerTypeQuantity Code="INF" Quantity="'.$data['no_of_infant'].'"/>';
        }

        if($data['return_date'] == "" || $data['return_date'] == null ||  $data['return_date'] ==  "Not Available"){
            $originDestinations = '
                <OriginDestinationInformation>
                  <DepartureDateTime>'.date('Y-m-d',strtotime($data['departure_date'])).'T00:00:00</DepartureDateTime>   
                  <OriginLocation LocationCode="'.$this->AmadeusConfig::iataCode($data['departure_city']).'"/>   
                  <DestinationLocation LocationCode="'.$this->AmadeusConfig::iataCode($data['destination_city']).'"/>  
                </OriginDestinationInformation> 
            ';
        }else{
            $originDestinations = '
                <OriginDestinationInformation>
                  <DepartureDateTime>'.date('Y-m-d',strtotime($data['departure_date'])).'T00:00:00</DepartureDateTime>   
                  <OriginLocation LocationCode="'.$this->AmadeusConfig::iataCode($data['departure_city']).'"/>   
                  <DestinationLocation LocationCode="'.$this->AmadeusConfig::iataCode($data['destination_city']).'"/>  
                </OriginDestinationInformation> 
                <OriginDestinationInformation>
                  <DepartureDateTime>'.date('Y-m-d',strtotime($data['return_date'])).'T00:00:00</DepartureDateTime>
                  <OriginLocation LocationCode="'.$this->AmadeusConfig::iataCode($data['destination_city']).'"/>   
                  <DestinationLocation LocationCode="'.$this->AmadeusConfig::iataCode($data['departure_city']).'"/>   
                </OriginDestinationInformation>
            ';
        }

       return '
            <wmLowFarePlus xmlns="http://traveltalk.com/wsLowFarePlus">
              <OTA_AirLowFareSearchPlusRQ>   
                '.$this->posXML().'
                '.$originDestinations.'
                <TravelPreferences>
                  <CabinPref Cabin="'.$data['cabin'].'"/>
                </TravelPreferences> 
                <TravelerInfoSummary>   
                  <SeatsRequested>'.($data['no_of_adult'] + $data['no_of_child']).'</SeatsRequested>
                  <AirTravelerAvail>
                    '.$passengers.'
                  </AirTravelerAvail>  
                  <PriceRequestInformation PricingSource="Both"/>
                </TravelerInfoSummary>
              </OTA_AirLowFareSearchPlusRQ>
            </wmLowFarePlus>';
    }

    public function lowFarePlusMultiDestinationRequestBodyXML($data){
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
        return '
              <OTA_AirLowFareSearchPlusRQ>   
                '.$this->posXML().'
                '.$originDestinations.'
                <TravelPreferences>
                  <CabinPref Cabin="'.$data['cabin'].'"/>
                </TravelPreferences> 
                <TravelerInfoSummary>   
                  <SeatsRequested>'.($data['no_of_adult'] + $data['no_of_child']).'</SeatsRequested>
                  <AirTravelerAvail>
                    '.$passengers.'
                  </AirTravelerAvail>  
                  <PriceRequestInformation PricingSource="Both"/>
                </TravelerInfoSummary>
              </OTA_AirLowFareSearchPlusRQ>';
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
        return '
              <OTA_AirLowFareSearchMatrixRQ>   
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
              </OTA_AirLowFareSearchMatrixRQ>';
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
        return '
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

    public function airPriceRequestXML($selectedItinerary, $searchParam){
		return '
		<OTA_AirPriceRQ>
		  '.$this->posXML().' 
		  <AirItinerary>   
		  <OriginDestinationOptions>    
		  <OriginDestinationOption>     
		  <FlightSegment DepartureDateTime="2006-03-02T09:32:00.0000000-05:00" ArrivalDateTime="2006-0302T11:23:00.0000000-05:00" FlightNumber="0197" ResBookDesigCode="L">    
		  <DepartureAirport LocationCode="MIA"/>
		  <ArrivalAirport LocationCode="ATL"/>      
		  <MarketingAirline Code="DL"/>     
		  </FlightSegment>    
		  </OriginDestinationOption>    
		  <OriginDestinationOption>     
		  <FlightSegment DepartureDateTime="2006-03-09T07:00:00.0000000-05:00" ArrivalDateTime="2006-0309T08:47:00.0000000-05:00" FlightNumber="1232" ResBookDesigCode="T">              <DepartureAirport LocationCode="ATL"/>
		  <ArrivalAirport LocationCode="MIA"/>      
		  <MarketingAirline Code="DL"/>     
		  </FlightSegment>    
		  </OriginDestinationOption>   
		  </OriginDestinationOptions>  
		  </AirItinerary>  
		  <TravelerInfoSummary>   
		  <SeatsRequested>1</SeatsRequested>   
		  <AirTravelerAvail>    
		  <PassengerTypeQuantity Code="ADT" Quantity="1"/>   
		  </AirTravelerAvail>   
		  <PriceRequestInformation PricingSource="Published"/>  
		  </TravelerInfoSummary> 
		  </OTA_AirPriceRQ> ';
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
		
	return '
<OTA_AirBookRQ>
   <AirItinerary DirectionInd="Circle">
      <OriginDestinationOptions>
         <OriginDestinationOption>
            <FlightSegment DepartureDateTime="2006-05-10T10:59:00" ArrivalDateTime="2006-0510T12:51:00" RPH="1" FlightNumber="0754" ResBookDesigCode="T" NumberInParty="1">
               <DepartureAirport LocationCode="MIA" />
               <ArrivalAirport LocationCode="ATL" />
               <MarketingAirline Code="DL" />
            </FlightSegment>
         </OriginDestinationOption>
         <OriginDestinationOption>
            <FlightSegment DepartureDateTime="2006-05-14T22:41:00" ArrivalDateTime="2006-0515T00:19:00" RPH="2" FlightNumber="1241" ResBookDesigCode="T" NumberInParty="1">
               <DepartureAirport LocationCode="ATL" />
               <ArrivalAirport LocationCode="MIA" />
               <MarketingAirline Code="DL" />
            </FlightSegment>
         </OriginDestinationOption>
      </OriginDestinationOptions>
   </AirItinerary>
</OTA_AirBookRQ>';
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

    public function travelBuildMainRequestElementXML($passengerInformation,$buildData,$buildType){
    	
    	return '<?xml version="1.0" encoding="UTF-8"?>
<OTA_TravelItineraryRQ>
   '.$this->posXML().'
   '.$this->buildTypeSort($buildType,$buildData).'
   <TPA_Extensions>
      <PNRData>
         <Traveler PassengerTypeCode="ADT" BirthDate="1952-07-24">
            <PersonName>
               <NamePrefix>MR</NamePrefix>
               <GivenName>JOHN</GivenName>
               <Surname>TEST</Surname>
               <NameTitle>MD</NameTitle>
            </PersonName>
            <TravelerRefNumber RPH="1" />
         </Traveler>
         <Telephone PhoneLocationType="Home" CountryAccessCode="1" AreaCityCode="MIA" PhoneNumber="305-444-4444" FormattedInd="0" />
         <Telephone PhoneLocationType="Business" CountryAccessCode="1" AreaCityCode="MIA" PhoneNumber="305-670-1561" FormattedInd="0" />
         <Email>info@Amadeus.com</Email>
         <Address FormattedInd="0" Type="Home">
            <StreetNmbr>7300 North Kendall Drive</StreetNmbr>
            <CityName>MIAMI</CityName>
            <PostalCode>33156</PostalCode>
            <StateProv StateCode="FL" />
            <CountryName Code="US" />
         </Address>
         <Ticketing TicketTimeLimit="2006-06-06T06:00:00" TicketType="eTicket" />
      </PNRData>
   </TPA_Extensions>
</OTA_TravelItineraryRQ>';
    }

    public function hotelAvailRequestXml($data){
		return '<OTA_HotelAvailRQ>
     '.$this->posXML().'
   <AvailRequestSegments>
      <AvailRequestSegment>
         <StayDateRange Start="2012-09-11" End="2012-09-18" />
         <RoomStayCandidates>
            <RoomStayCandidate>
               <GuestCounts IsPerRoom="true">
                  <GuestCount Count="1" />
               </GuestCounts>
            </RoomStayCandidate>
         </RoomStayCandidates>
         <HotelSearchCriteria>
            <Criterion ExactMatch="true">
               <HotelRef HotelCityCode="DUS" />
            </Criterion>
         </HotelSearchCriteria>
      </AvailRequestSegment>
   </AvailRequestSegments>
</OTA_HotelAvailRQ>';
	}
	
	public function hotelAvailRoomRequestXML($data){
		return '<OTA_HotelAvailRQ>
     '.$this->posXML().'
   <AvailRequestSegments>
      <AvailRequestSegment>
         <StayDateRange Start="2012-09-11" End="2012-09-18" />
         <RoomStayCandidates>
            <RoomStayCandidate>
               <GuestCounts IsPerRoom="true">
                  <GuestCount Count="1" />
               </GuestCounts>
            </RoomStayCandidate>
         </RoomStayCandidates>
         <HotelSearchCriteria>
            <Criterion ExactMatch="true">
               <HotelRef ChainCode="NS" HotelCode="CEN" HotelCityCode="DUS" />
            </Criterion>
         </HotelSearchCriteria>
      </AvailRequestSegment>
   </AvailRequestSegments>
</OTA_HotelAvailRQ>';
	}

    public function hotelAvailRoomDetailsRequestXML($data) {
		return '<OTA_HotelAvailRQ>
     '.$this->posXML().'
   <AvailRequestSegments>
      <AvailRequestSegment>
         <StayDateRange Start="2012-09-11" End="2012-09-18" />
         <RoomStayCandidates>
            <RoomStayCandidate>
               <GuestCounts IsPerRoom="true">
                  <GuestCount Count="1" />
               </GuestCounts>
            </RoomStayCandidate>
         </RoomStayCandidates>
         <HotelSearchCriteria>
            <Criterion ExactMatch="true">
               <HotelRef ChainCode="NS" HotelCode="CEN" HotelCityCode="DUS" />
            </Criterion>
         </HotelSearchCriteria>
         <RatePlanCandidates>
            <RatePlanCandidate RatePlanID="C1TR0154HA"/>    
          </RatePlanCandidates> 
      </AvailRequestSegment>
   </AvailRequestSegments>
</OTA_HotelAvailRQ>';
	}












}