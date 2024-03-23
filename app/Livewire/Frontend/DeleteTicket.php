<?php

namespace App\Livewire\Frontend;

use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DeleteTicket extends ModalComponent
{
    public string $rowId;
    public function render()
    {
        return view('livewire.frontend.delete-ticket');
    }
}
