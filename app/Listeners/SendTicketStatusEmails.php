<?php

namespace App\Listeners;

use App\Events\TicketStatusChangedEvent;
use App\Mail\Backend\TicketCreatedMail as BackendTicketCreatedMail;
use App\Mail\Frontend\AssignedAgentMail;
use App\Mail\Frontend\TicketClosedMail;
use App\Mail\Frontend\TicketCreatedMail as UserTicketCreatedMail;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SendTicketStatusEmails
{
    public function __construct()
    {
    }

    public function handle(TicketStatusChangedEvent $event)
    : void
    {
        switch ($event->ticket->status) {
            case 0:
                $this->ticket_created_emails($event->ticket);
                break;
            case 1:
                $this->ticket_assigned_agent_emails($event->ticket);
                break;
            case 2:
                $this->closed_ticket_emails($event->ticket);
                break;
        }
    }

    private function ticket_created_emails(Ticket $ticket)
    : void
    {
        Mail::to($ticket->user->email)->send(new UserTicketCreatedMail($ticket));
        User::where('type', 2)->where('department_id', $ticket->category->department_id)->each(function ($agent) use ($ticket) {
            Mail::to($agent->email)->send(new BackendTicketCreatedMail($ticket));
        });
    }

    private function ticket_assigned_agent_emails(Ticket $ticket)
    : void
    {
        Mail::to($ticket->user->email)->send(new AssignedAgentMail($ticket));
    }

    private function closed_ticket_emails(Ticket $ticket)
    : void
    {
        Mail::to($ticket->user->email)->send(new TicketClosedMail($ticket));
    }
}
