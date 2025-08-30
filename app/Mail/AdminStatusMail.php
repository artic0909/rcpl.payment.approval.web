<?php

namespace App\Mail;

use App\Models\PaymentApproval;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $payment;
    public $status;

    /**
     * Create a new message instance.
     */
    public function __construct(PaymentApproval $payment, $status)
    {
        $this->payment = $payment;
        $this->status  = $status;
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Payment Request Status update',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.status-email',
            with: [
                'payment' => $this->payment,
                'status'  => $this->status,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
