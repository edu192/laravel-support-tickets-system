<?php

namespace App\Livewire\Backend;

use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DeleteUserModal extends ModalComponent
{
    public int $userId;
    public function render()
    {
        return view('livewire.backend.delete-user-modal');
    }

    public function delete_user()
    {
        $user=User::find($this->userId);
        $user->delete();
        $this->dispatch('pg:eventRefresh-default');
        toastr()->success('User deleted successfully!');
        $this->closeModal();
    }
}
