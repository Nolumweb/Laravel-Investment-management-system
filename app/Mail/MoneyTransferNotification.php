<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;


class MoneyTransferNotification extends Mailable
{
    use Queueable, SerializesModels;

    
        public $sender;
        public $recipient;
        public $amount;
    
        /**
         * Create a new message instance.
         *
         * @return void
         */
        public function __construct(User $sender, User $recipient, $amount)
        {
            $this->sender = $sender;
            $this->recipient = $recipient;
            $this->amount = $amount;
        }
    
        /**
         * Build the message.
         *
         * @return $this
         */
        public function build()
        {
            return $this->markdown('mail.money_transfer_notification');
        }
    }
    






