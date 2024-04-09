<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Investment;

class InvestmentConfirmationNotification extends Mailable
{
    use Queueable, SerializesModels;


    public $investment;

    /**
     * Create a new message instance.
     */
    public function __construct(Investment $investment)
    {
        $this->investment = $investment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Investment Confirmation')->markdown('mail.investment_confirmation_notification');
    }
}


