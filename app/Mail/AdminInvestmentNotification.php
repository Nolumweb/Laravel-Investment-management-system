<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Investment;


class AdminInvestmentNotification extends Mailable
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
        return $this->subject('New Investment Made')->markdown('mail.admin.investment_notification');
    }
}











