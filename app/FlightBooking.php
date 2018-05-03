<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlightBooking extends Model
{
    protected $fillable = [
        'user_id'             ,
        'reference'           ,
        'pnr'                 ,
        'itinerary_amount'    ,
        'markup'              ,
        'markdown'            ,
        'vat'                 ,
        'voucher_id'          ,
        'voucher_amount'      ,
        'total_amount'        ,
        'ticket_time_limit'   ,
        'payment_status'      ,
        'issue_ticket_status' ,
        'void_ticket_status'  ,
        'cancel_ticket_status',
        'pnr_request_response',
    ];

    public static function store($sortedResponse,$user,$selectedItinerary){

        return static::create([
            'user_id'              => $user->id,
            'reference'            => 'AIR-'.strtoupper(str_random(5)),
            'pnr'                  => $sortedResponse['pnr'],
            'itinerary_amount'     => $selectedItinerary['defaultItineraryPrice'],
            'markup'               => $selectedItinerary['markup'],
            'markdown'             => $selectedItinerary['airlineMarkdown'],
            'vat'                  => $selectedItinerary['vat'],
            'voucher_id'           => array_get($selectedItinerary,'voucher_id',0),
            'voucher_amount'       => array_get($selectedItinerary,'voucher_amount',0),
            'total_amount'         => $selectedItinerary['displayTotal'],
            'ticket_time_limit'    => $selectedItinerary['ticketTimeLimit'],
            'payment_status'       => 0,
            'issue_ticket_status'  => 0,
            'void_ticket_status'   => 0,
            'cancel_ticket_status' => 0,
            'pnr_request_response' => json_encode($sortedResponse,true)
        ]);

    }
}
