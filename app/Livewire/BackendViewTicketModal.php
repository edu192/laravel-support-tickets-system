<?php

namespace App\Livewire;

use App\Models\Ticket;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class BackendViewTicketModal extends ModalComponent
{
    public Ticket $ticket;
    public function render()
    {
        return view('livewire.backend-view-ticket-modal');
    }
}
