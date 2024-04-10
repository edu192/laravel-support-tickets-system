<?php

namespace App\Mail\Frontend;

use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CommentCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(protected Comment $comment)
    {
    }

    public function envelope()
    : Envelope
    {
        return new Envelope(
            subject: 'Ticket response',
        );
    }

    public function content()
    : Content
    {
        return new Content(
            markdown: 'emails.frontend.comment-created',
            with: ['comment' => $this->comment]
        );
    }

    public function attachments()
    : array
    {
        return [];
    }
}
