<?php

namespace App\Livewire\Backend\Department;

use App\Models\Department;
use LivewireUI\Modal\ModalComponent;

class CreateModal extends ModalComponent
{
    public string $name = '';

    public function render()
    {
        $this->authorize('create', Department::class);
        return view('livewire.backend.department.create-modal');
    }

    public static function modalMaxWidth()
    : string
    {
        return 'md';
    }

    public function create()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        $department = new Department();
        $department->name = $this->name;
        $department->save();
        toastr()->success('Department created successfully');
        $this->dispatch('pg:eventRefresh-default');
        $this->closeModal();
    }
}
