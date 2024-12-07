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
            $agent->notify(new FileCreatedNotification($file->ticket_id, "El ticket ({$file->ticket_id}) ha recibido un nuevo archivo del usuario.", route('backend.ticket.comments', $file->ticket_id)));
        });
    }
}
