<?php

namespace App\Livewire\Backend\User;

use App\Models\Department;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class EditModal extends ModalComponent
{
    public User $user;
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public int $type = 1;
    public string $phone = '';
    public string $address = '';
//    public string $image = '';
    public ?string $department_id = null;

    public bool $isDisabled = false;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->type = $user->type;
        $this->phone = $user->phone;
        $this->address = $user->address;
        $this->department_id = $user->department_id;
    }

    public function render()
    {
        $this->authorize('create', User::class);
        $this->departmentInputStatus();
        return view('livewire.backend.user.edit-modal', ['departments' => Department::all()]);
    }

    public function departmentInputStatus()
    {
        if ($this->type !== 2) {
            $this->isDisabled = true;
        } else {
            $this->isDisabled = false;
        }
    }

    public function update_user()
    {
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'type' => 'required|integer',
            'phone' => 'required|string',
            'address' => 'required|string',
            'department_id' => 'nullable|integer',
            'password' => 'nullable|string|confirmed',
        ]);

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'type' => $this->type,
            'phone' => $this->phone,
            'image' => 'default.jpg',
            'address' => $this->address,
            'department_id' => $this->department_id,
            'password' => $this->password ? $this->password : $this->user->password,
        ]);

        toastr()->success('User updated successfully');
        $this->dispatch('pg:eventRefresh-default');
        $this->closeModal();
    }
}
