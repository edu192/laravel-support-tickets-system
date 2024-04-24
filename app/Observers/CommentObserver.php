<?php

namespace App\Observers;

use App\Models\Comment;
use App\Notifications\CommentCreatedNotification;

class CommentObserver
{
    public function created(Comment $comment)
    : void
    {
        if ($comment->user_id !== $comment->ticket->user->id) {
            $comment->user->notify(new CommentCreatedNotification($comment->id, "Your ticket ({$comment->ticket_id}) has received a new comment from our support agent.", route('user.ticket.show', $comment->ticket_id)));
        } else {
            $comment->ticket->assigned_agent()->each(function ($agent) use ($comment) {
                $agent->notify(new CommentCreatedNotification($comment->id, "Ticket ({$comment->ticket_id}) has received a new comment from the user.", route('backend.ticket.comments', $comment->ticket_id)));
            });
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
