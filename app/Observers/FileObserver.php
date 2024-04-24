<?php

namespace App\Observers;

use App\Models\File;
use App\Notifications\FileCreatedNotification;

class FileObserver
{
    public function created(File $file)
    : void
    {
        $file->ticket->assigned_agent()->each(function ($agent) use ($file) {
            $agent->notify(new FileCreatedNotification($file->ticket_id, "Ticket ({$file->ticket_id}) has received a new file from the user.", route('backend.ticket.comments', $file->ticket_id)));
        });
    }
}
