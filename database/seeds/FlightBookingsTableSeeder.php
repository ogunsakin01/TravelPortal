<?php

use Illuminate\Database\Seeder;
use App\FlightBooking;

class FlightBookingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bookings = [
            [
                'user_id'              => '4',
                'reference'            => 'AIR-KLAHGV',
                'pnr'                  => 'TVPR7W',
                'itinerary_amount'     => 20525800,
                'markup'               => 205258,
                'markdown'             => 0,
                'vat'                  => 0,
                'voucher_id'           => 0,
                'voucher_amount'       => 0,
                'total_amount'         => 20731058,
                'ticket_time_limit'    => '2018-04-24T23:59:00',
                'payment_status'       => 0,
                'issue_ticket_status'  => 0,
                'void_ticket_status'   => 0,
                'cancel_ticket_status' => 0,
                'pnr_request_response' => '{"pnr":"TVPR7W","flights":[{"@attributes":{"Status":"HK","ItinSeqNumber":"2"},"Air":{"@attributes":{"DepartureDateTime":"2018-04-24T22:35:00","ArrivalDateTime":"2018-04-25T04:20:00","StopQuantity":"0","RPH":"1","FlightNumber":"780","ResBookDesigCode":"T","NumberInParty":"1","Status":"HK","E_TicketEligibility":"Eligible","DepartureDay":"Tue","OrginDestType":"First"},"DepartureAirport":"London-Heathrow, United Kingdom","ArrivalAirport":"Cairo-Cairo Intl, Egypt","OperatingAirline":"Egyptair","Equipment":"BOEING 737-800 JET","MarketingAirline":"Egyptair","MarriageGrp":"MIN1","TPA_Extensions":{"@attributes":{"ConfirmationNumber":"TVPR7W"}}}},{"@attributes":{"Status":"HK","ItinSeqNumber":"3"},"Air":{"@attributes":{"DepartureDateTime":"2018-04-25T05:25:00","ArrivalDateTime":"2018-04-25T10:55:00","StopQuantity":"0","RPH":"2","FlightNumber":"901","ResBookDesigCode":"T","NumberInParty":"1","Status":"HK","E_TicketEligibility":"Eligible","DepartureDay":"Wed","OrginDestType":"Intermediate"},"DepartureAirport":"Cairo-Cairo Intl, Egypt","ArrivalAirport":"Dubai-Dubai Intl, United Arab Emirates","OperatingAirline":"Egyptair","Equipment":"BOEING 737-800 JET","MarketingAirline":"Egyptair","MarriageGrp":"MIN1","TPA_Extensions":{"@attributes":{"ConfirmationNumber":"TVPR7W"}}}},{"@attributes":{"Status":"HK","ItinSeqNumber":"4"},"Air":{"@attributes":{"DepartureDateTime":"2018-04-28T05:20:00","ArrivalDateTime":"2018-04-28T07:00:00","StopQuantity":"0","RPH":"3","FlightNumber":"911","ResBookDesigCode":"T","NumberInParty":"1","Status":"HK","E_TicketEligibility":"Eligible","DepartureDay":"Sat","OrginDestType":"First"},"DepartureAirport":"Dubai-Dubai Intl, United Arab Emirates","ArrivalAirport":"Cairo-Cairo Intl, Egypt","OperatingAirline":"Egyptair","Equipment":"AIRBUS INDUSTRIE A330-300 JET","MarketingAirline":"Egyptair","MarriageGrp":"MIN2","TPA_Extensions":{"@attributes":{"ConfirmationNumber":"TVPR7W"}}}},{"@attributes":{"Status":"HK","ItinSeqNumber":"5"},"Air":{"@attributes":{"DepartureDateTime":"2018-04-28T09:10:00","ArrivalDateTime":"2018-04-28T13:35:00","StopQuantity":"0","RPH":"4","FlightNumber":"777","ResBookDesigCode":"T","NumberInParty":"1","Status":"HK","E_TicketEligibility":"Eligible","DepartureDay":"Sat","OrginDestType":"Intermediate"},"DepartureAirport":"Cairo-Cairo Intl, Egypt","ArrivalAirport":"London-Heathrow, United Kingdom","OperatingAirline":"Egyptair","Equipment":"BOEING 777-300 JET","MarketingAirline":"Egyptair","MarriageGrp":"MIN2","TPA_Extensions":{"@attributes":{"ConfirmationNumber":"TVPR7W"}}}}],"bagsAllowance":[{"@attributes":{"PricingSource":"Private","TravelerRefNumberRPHList":"1","FlightRefNumberRPHList":"2 3 4 5","RPH":"1"},"PassengerTypeQuantity":{"@attributes":{"Code":"ADT","Quantity":"1"}},"FareBasisCodes":{"FareBasisCode":["TLRIGB","TLRIGB","TLRIGB","TLRIGB"]},"PassengerFare":{"BaseFare":{"@attributes":{"Amount":"56247","CurrencyCode":"NGN","DecimalPlaces":"0"}},"EquivFare":{"@attributes":{"Amount":"11000","CurrencyCode":"GBP","DecimalPlaces":"2"}},"Taxes":{"Tax":[{"@attributes":{"Code":"YQ","Amount":"7200","DecimalPlaces":"0"}},{"@attributes":{"Code":"YQ","Amount":"3600","DecimalPlaces":"0"}},{"@attributes":{"Code":"YR","Amount":"62384","DecimalPlaces":"0"}},{"@attributes":{"Code":"GB","Amount":"39885","DecimalPlaces":"0"}},{"@attributes":{"Code":"UB","Amount":"22964","DecimalPlaces":"0"}},{"@attributes":{"Code":"EQ","Amount":"720","DecimalPlaces":"0"}},{"@attributes":{"Code":"AE","Amount":"7353","DecimalPlaces":"0"}},{"@attributes":{"Code":"F6","Amount":"3432","DecimalPlaces":"0"}},{"@attributes":{"Code":"TP","Amount":"491","DecimalPlaces":"0"}},{"@attributes":{"Code":"ZR","Amount":"982","DecimalPlaces":"0"}}]},"TotalFare":{"@attributes":{"Amount":"205258","CurrencyCode":"NGN","DecimalPlaces":"0"}}},"TPA_Extensions":{"FareCalculation":"LON MS X\/CAI MS DXB M\/IT TLRIGB\/PV MS X\/CAI MS LON M\/IT TLRIGB\/PV END","ValidatingAirlineCode":"*F*MS","BagAllowance":[{"@attributes":{"Quantity":"1","Type":"Piece","ItinSeqNumber":"2"}},{"@attributes":{"Quantity":"1","Type":"Piece","ItinSeqNumber":"3"}},{"@attributes":{"Quantity":"1","Type":"Piece","ItinSeqNumber":"4"}},{"@attributes":{"Quantity":"1","Type":"Piece","ItinSeqNumber":"5"}}]}}],"passengers":[{"@attributes":{"RPH":"1"},"Customer":{"PersonName":{"@attributes":{"NameType":"ADT"},"GivenName":"DAMILOLA OLAMIDE MR","Surname":"OGUNSAKIN"},"Telephone":{"@attributes":{"PhoneNumber":"LOS","PhoneUseType":"H"}},"Email":"OGUNSAKIN191@GMAIL.COM"}}]}'
            ],
            [
                'user_id'              => '4',
                'reference'            => 'AIR-AQLYZT',
                'pnr'                  => 'TVQ532',
                'itinerary_amount'     => 60615000,
                'markup'               => 606150,
                'markdown'             => 0,
                'vat'                  => 0,
                'voucher_id'           => 0,
                'voucher_amount'       => 0,
                'total_amount'         => 61221150,
                'ticket_time_limit'    => '2018-04-26T23:59:00',
                'payment_status'       => 0,
                'issue_ticket_status'  => 0,
                'void_ticket_status'   => 0,
                'cancel_ticket_status' => 0,
                'pnr_request_response' => ''
            ]
        ];

        foreach($bookings as $serial => $booking){
            FlightBooking::create($booking);
        }
    }
}
