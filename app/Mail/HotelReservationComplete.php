<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class HotelReservationComplete extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $user;

    public $hotelInfo;

    public $roomInfo;

    public $bookingInfo;

    public function __construct($user,$hotelInfo,$roomInfo,$bookingInfo)
    {
        $this->user        = $user;
        $this->hotelInfo   = $hotelInfo;
        $this->roomInfo    = $roomInfo;
        $this->bookingInfo = $bookingInfo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        return $this->from('no-reply@travelpro.com.ng',config('app.name'))
                    ->subject('Hotel Room Reservation')
                    ->markdown('emails.HotelReservationComplete');
    }
}
