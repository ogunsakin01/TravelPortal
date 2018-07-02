<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReservationCancelled extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $user;

    public $booking;

    public function __construct($user,$booking)
    {
        $this->user = $user;
        $this->booking  = $booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Reservation Cancelled')
            ->from('no-reply@travelpro.com.ng',config('app.name'))
            ->markdown('emails.ReservationCancelled');
    }
}
