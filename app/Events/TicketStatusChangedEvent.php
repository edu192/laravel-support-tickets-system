<?php

namespace App\Events;

use App\Models\Ticket;
use Illuminate\Foundation\Events\Dispatchable;

class TicketStatusChangedEvent
{
    use Dispatchable;

    public function __construct(public Ticket $ticket)
    {
    }
}
