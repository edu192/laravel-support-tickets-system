<?php

namespace App\Livewire\Backend\Ticket\Agent;

use App\Models\Ticket;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class SelfAssignModal extends ModalComponent
{
    public $user_id;
    public $ticket_id;

    public function render()
    {
        return view('livewire.backend.ticket.agent.self-assign-modal');
    }

    public function assign()
    {
        $ticket = Ticket::find($this->ticket_id);
        $ticket->assigned_agent()->syncWithoutDetaching($this->user_id);
        $ticket->status = 1;
        return redirect()->route('backend.ticket.comments', $this->ticket_id);
    }
}
