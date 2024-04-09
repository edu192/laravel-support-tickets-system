<?php

namespace App\Livewire\Backend\User;

use App\Models\Department;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class CreateModal extends ModalComponent
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public int $type = 1;
    public string $phone = '';
    public string $address = '';
//    public string $image = '';
    public string $department_id = '';

    public bool $isDisabled = false;

    public function render()
    {
        $this->authorize('create', User::class);
        return view('livewire.backend.user.create-modal', ['departments' => Department::all()]);
    }

    public function departmentInputStatus()
    {
        if ($this->type !== 2) {
            $this->isDisabled = true;
        } else {
            $this->isDisabled = false;
        }
    }

    public function create_user()
    {
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
            'type' => 'required|integer',
            'phone' => 'required|string',
            'address' => 'required|string',
            'department_id' => 'required|integer',
        ]);
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'type' => $this->type,
            'phone' => $this->phone,
            'image' => 'default.jpg',
            'address' => $this->address,
            'department_id' => $this->department_id,
        ]);
        toastr()->success('User created successfully');
        $this->closeModal();
    }
}
