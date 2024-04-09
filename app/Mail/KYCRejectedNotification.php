<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\KYCDocument;

class KYCRejectedNotification extends Mailable
{
    use Queueable, SerializesModels;




    public $kyc;

    /**
     * Create a new message instance.
     */
    public function __construct(KYCDocument $kyc)
    {
        $this->kyc = $kyc;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('KYC Document Rejected')->markdown('mail.kyc_rejected_notification');
    }
}


