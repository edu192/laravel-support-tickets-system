<?php

namespace App\Livewire\Backend;

use App\Models\Department;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DepartmentCreateModal extends ModalComponent
{
    public string $name = '';

    public function render()
    {
        return view('livewire.backend.department-create-modal');
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
