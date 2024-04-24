<?php

namespace App\Listeners;

use App\Events\TicketStatusChangedEvent;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\TicketUpdatedNotification;

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
//        Mail::to($ticket->user->email)->send(new UserTicketCreatedMail($ticket));
        $ticket->user->notify(new TicketUpdatedNotification(
            $ticket->id,
            'Ticket received',
            'Your ticket has been received. You will be notified when an agent is assigned to your ticket.',
            route('user.ticket.show', $ticket->id)));
        User::where('type', 2)->where('department_id', $ticket->category->department_id)->each(function ($agent) use ($ticket) {
            $agent->notify(new TicketUpdatedNotification(
                $ticket->id,
                'A new ticket has been created',
                "A new ticket has been created in the {$ticket->category->name} category.",
                route('backend.ticket.unassigned')));
        });
    }

    private function ticket_assigned_agent_emails(Ticket $ticket)
    : void
    {
        $ticket->user->notify(new TicketUpdatedNotification(
            $ticket->id,
            'Your ticket has been assigned to an agent',
            "Your ticket has been assigned to an agent. You will be notified when the agent responds.",
            route('user.ticket.show', $ticket->id)));
    }

    private function closed_ticket_emails(Ticket $ticket)
    : void
    {
        $ticket->user->notify(new TicketUpdatedNotification(
            $ticket->id,
            'Your ticket has been closed',
            "Your ticket has been closed. If you have any further questions, please open a new ticket.",
            route('user.ticket.show', $ticket->id)));
    }
}
