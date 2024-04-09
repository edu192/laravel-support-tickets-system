<?php

namespace App\Livewire\Backend\Ticket;

use App\Models\Ticket;
use LivewireUI\Modal\ModalComponent;

class ViewModal extends ModalComponent
{
    public Ticket $ticket;

    public function render()
    {
        return view('livewire.backend.ticket.view-modal');
    }

    public function show_comments()
    {
        if ($this->ticket->assigned_agent->count() > 0) {
            return redirect()->route('backend.ticket.comments', $this->ticket->id);
        } else {
            $this->dispatch('openModal', component: 'backend.ticket.agent.self-assign-modal', arguments: ['user_id' => auth()->user()->id, 'ticket_id' => $this->ticket->id]);
        }
    }
}
