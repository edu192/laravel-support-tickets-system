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
}
