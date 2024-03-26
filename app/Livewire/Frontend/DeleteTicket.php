<?php

namespace App\Livewire\Frontend;

use App\Livewire\TicketUserTable;
use App\Models\Ticket;
use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DeleteTicket extends ModalComponent
{
    public string $rowId;

    public function mount()
    {

    }
    public function render()
    {
        return view('livewire.frontend.delete-ticket');
    }

    public function delete_ticket()
    {
        $ticket = Ticket::find($this->rowId);
        $ticket->delete();
        $this->dispatch('pg:eventRefresh-default');
        toastr()->success('Ticket deleted successfully!');
        $this->closeModal();
    }
}
