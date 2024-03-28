<?php

namespace App\Livewire\Backend;

use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class UserViewModal extends ModalComponent
{
    public User $user;
    public function render()
    {
        return view('livewire.backend.user-view-modal');
    }

    public static function modalMaxWidth(): string
    {
        return 'sm';
    }
}
