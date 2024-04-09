<?php

namespace App\Livewire\Backend\User;

use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class DeleteModal extends ModalComponent
{
    public int $userId;
    public function render()
    {
        return view('livewire.backend.user.delete-modal');
    }

    public function delete_user()
    {
        $this->authorize('create', User::class);
        $user=User::find($this->userId);
        $user->delete();
        $this->dispatch('pg:eventRefresh-default');
        toastr()->success('User deleted successfully!');
        $this->closeModal();
    }
}
