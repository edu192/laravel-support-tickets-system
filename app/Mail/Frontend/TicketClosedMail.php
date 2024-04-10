<?php

namespace App\Mail\Frontend;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketClosedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(protected Ticket $ticket)
    {
    }

    public function envelope()
    : Envelope
    {
        return new Envelope(
            subject: 'Ticket Closed',
        );
    }

    public function content()
    : Content
    {
        return new Content(
            markdown: 'emails.frontend.ticket-closed',
            with: ['ticket' => $this->ticket],
        );
    }

    public function attachments()
    : array
    {
        return [];
    }
}
