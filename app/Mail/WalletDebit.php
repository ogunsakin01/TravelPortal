<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WalletDebit extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $user;

    public $walletLog;

    public function __construct($user,$walletLog)
    {
        $this->user = $user;
        $this->walletLog = $walletLog;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        return $this->from('no-reply@travelpro.com.ng',config('app.name'))
                    ->subject('Wallet Debit Alert')
                    ->markdown('emails.WalletDebit');
    }
}
