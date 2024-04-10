<?php

namespace App\Livewire\Frontend\Ticket;

use App\Models\Ticket;
use LivewireUI\Modal\ModalComponent;

class DeleteModal extends ModalComponent
{
    public string $rowId;

    public function mount()
    {

    }
    public function render()
    {
        $this->authorize('delete',Ticket::find($this->rowId));
        return view('livewire.frontend.ticket.delete-modal');
    }

    public function delete_ticket()
    {
        $this->authorize('delete',Ticket::find($this->rowId));
        $ticket = Ticket::find($this->rowId);
        $this->authorize('delete',$ticket);
        $ticket->delete();
        $this->dispatch('pg:eventRefresh-default');
        toastr()->success('Ticket deleted successfully!');
        $this->closeModal();
    }
}
