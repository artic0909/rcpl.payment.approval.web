<?php

namespace App\Mail;

use App\Models\CommercialRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CommercialRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $commercialRequest;

    /**
     * Create a new message instance.
     */
    public function __construct(CommercialRequest $commercialRequest)
    {
        $this->commercialRequest = $commercialRequest;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Payment Request - ' . $this->commercialRequest->payment_type,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.commercial-request-email', // <- your blade file
            with: [
                'commercialRequest' => $this->commercialRequest,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
