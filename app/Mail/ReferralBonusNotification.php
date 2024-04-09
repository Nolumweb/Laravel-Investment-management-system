<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;


class ReferralBonusNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $commission;

  
    public function __construct(User $user, $commission)
    {
        $this->user = $user;
        $this->commission = $commission;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Referral Bonus Notification')->markdown('emails.referral_bonus_notification');
    }
}


