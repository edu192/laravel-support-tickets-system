<?php

namespace App\Observers;

use App\Mail\TicketCreatedMail;
use App\Models\Ticket;
use Illuminate\Support\Facades\Mail;

class TicketObserver
{
    public function created(Ticket $ticket)
    : void
    {
        Mail::to($ticket->user->email)->send(new TicketCreatedMail($ticket));
    }

    public function updated(Ticket $ticket)
    : void
    {
    }

    public function deleted(Ticket $ticket)
    : void
    {
    }

    public function restored(Ticket $ticket)
    : void
    {
    }
}
