<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PackageReservationComplete extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $deal;

    public $booking;

    public $user;


    public function __construct($booking,$deal,$user)
    {
        $this->deal = $deal;
        $this->booking = $booking;
        $this->user = $user;
    }

    /**
     *
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        return $this->from('no-reply@travelpro.com.ng',config('app.name'))
                    ->subject('Travel Deal Booking')
                    ->markdown('emails.PackageReservationComplete');
    }

}
