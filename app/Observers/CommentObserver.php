<?php

namespace App\Observers;

use App\Mail\Frontend\CommentCreatedMail;
use App\Models\Comment;
use Illuminate\Support\Facades\Mail;

class CommentObserver
{
    public function created(Comment $comment)
    : void
    {
        if ($comment->user->id !== $comment->ticket->user->id) {
            Mail::to($comment->ticket->user->email)->send(new CommentCreatedMail($comment));
        }
    }

    public function updated(Comment $comment)
    : void
    {
    }

    public function deleted(Comment $comment)
    : void
    {
    }

    public function restored(Comment $comment)
    : void
    {
    }
}
