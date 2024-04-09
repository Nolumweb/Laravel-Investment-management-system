<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Transaction;

class UserWithdrawalApprovedNotification extends Mailable
{
    use Queueable, SerializesModels;

    

    public $withdrawal;

    /**
     * Create a new message instance.
     */
    public function __construct(Transaction $withdrawal)
    {
        $this->withdrawal = $withdrawal;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Withdrawal Has Been Approved')
                    ->markdown('mail.user.user_withdrawal_approved');

    }
}
