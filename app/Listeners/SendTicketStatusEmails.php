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
        $ticket->user->notify(new TicketUpdatedNotification(
            $ticket->id,
            'Ticket recibido',
            'Su ticket ha sido recibido. Se le notificará cuando se asigne un agente a su ticket.',
            route('user.ticket.show', $ticket->id)));
        User::where('type', 2)->where('department_id', $ticket->category->department_id)->each(function ($agent) use ($ticket) {
            $agent->notify(new TicketUpdatedNotification(
                $ticket->id,
                'Se ha creado un nuevo ticket',
                "Se ha creado un nuevo ticket en la categoría {$ticket->category->name}.",
                route('backend.ticket.unassigned')));
        });
    }

    private function ticket_assigned_agent_emails(Ticket $ticket)
    : void
    {
        $ticket->user->notify(new TicketUpdatedNotification(
            $ticket->id,
            'Su ticket ha sido asignado a un agente',
            "Su ticket ha sido asignado a un agente. Se le notificará cuando el agente responda.",
            route('user.ticket.show', $ticket->id)));
    }

    private function closed_ticket_emails(Ticket $ticket)
    : void
    {
        $ticket->user->notify(new TicketUpdatedNotification(
            $ticket->id,
            'Su ticket ha sido cerrado',
            "Su ticket ha sido cerrado. Si tiene alguna otra pregunta, por favor abra un nuevo ticket.",
            route('user.ticket.show', $ticket->id)));
    }
}
