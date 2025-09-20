<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\CommercialRequest;

class CommercialRequestApprovalStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $request; // expose to view

    public function __construct(CommercialRequest $request)
    {
        $this->request = $request;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Payment Request ' . ucfirst($this->request->approval_status),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.commercial-request-approval-status-email', // update with your email blade path
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
