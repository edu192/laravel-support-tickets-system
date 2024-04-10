<?php

namespace App\Observers;

use App\Mail\Backend\TicketCreatedMail as BackendTicketCreatedMail;
use App\Mail\Frontend\TicketCreatedMail as UserTicketCreatedMail;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class TicketObserver
{
    public function created(Ticket $ticket)
    : void
    {
        Mail::to($ticket->user->email)->send(new UserTicketCreatedMail($ticket));
        $employees = User::where('department_id', $ticket->category->department_id)
            ->where('type', 2)
            ->get();
        foreach ($employees as $employee) {
            Mail::to($employee->email)->send(new BackendTicketCreatedMail($ticket));
        }
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
