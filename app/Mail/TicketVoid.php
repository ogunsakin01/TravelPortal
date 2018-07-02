<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TicketVoid extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $user;

    public $ticketNumber;

    public function __construct($user,$ticketNumber)
    {
        $this->user = $user;
        $this->ticketNumber = $ticketNumber;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Void Ticket Successful')
            ->from('no-reply@travelpro.com.ng',config('app.name'))
            ->markdown('emails.TicketVoid');
    }
}
