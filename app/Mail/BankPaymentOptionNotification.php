<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BankPaymentOptionNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $booking;


    public function __construct($booking)
    {
        $this->booking         = $booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        return $this->from('no-reply@travelpro.com.ng',config('app.name'))
            ->subject('Bank Payment Notification')
            ->markdown('emails.BankPaymentOptionNotification');
    }
}
