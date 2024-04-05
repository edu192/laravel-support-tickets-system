<?php

namespace App\Livewire\Backend;

use App\Models\Ticket;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class TicketAttachedFilesModal extends ModalComponent
{
    public Ticket $ticket;
    public function render()
    {
        return view('livewire.backend.ticket-attached-files-modal');
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }
}
