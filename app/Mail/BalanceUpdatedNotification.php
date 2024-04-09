<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class BalanceUpdatedNotification extends Mailable
{
    use Queueable, SerializesModels;



    public $user;
    public $amount;
    public $transactionType;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, $amount, $transactionType)
    {
        $this->user = $user;
        $this->amount = $amount;
        $this->transactionType = $transactionType;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->transactionType === 'deduct' ? 'Balance Deducted' : 'Balance Credited';
        return $this->subject($subject)->markdown('mail.balance_updated_notification');
    }
}


