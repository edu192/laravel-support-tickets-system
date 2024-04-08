<?php

namespace App\Livewire\Backend\User;

use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class ViewModal extends ModalComponent
{
    public User $user;
    public function render()
    {
        return view('livewire.backend.user.view-modal');
    }

    public static function modalMaxWidth(): string
    {
        return 'sm';
    }
}
