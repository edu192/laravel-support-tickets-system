<?php

namespace App\Livewire\Backend\Ticket;

use App\Events\TicketStatusChangedEvent;
use App\Models\Ticket;
use LivewireUI\Modal\ModalComponent;

class CloseTicketModal extends ModalComponent
{
    public Ticket $ticket;

    public function render()
    {
        return view('livewire.backend.ticket.close-ticket-modal');
    }

    public function close_ticket()
    {
        $this->ticket->status = 2;
        $this->ticket->save();
        event(new TicketStatusChangedEvent($this->ticket));
        toastr()->success('Ticket closed successfully!');
        $this->closeModal();
        return redirect()->route('backend.ticket.comments', $this->ticket->id);
    }
}
