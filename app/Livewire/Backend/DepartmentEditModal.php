<?php

namespace App\Livewire\Backend;

use App\Models\Department;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DepartmentEditModal extends ModalComponent
{
    public int $id = 0;
    public string $name = '';

    public function mount(Department $department)
    {
        $this->id = $department->id;
        $this->name = $department->name;
    }

    public function render()
    {
        return view('livewire.backend.department-edit-modal');
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }

    public function update_department()
    {
        $this->validate([
            'name' => 'required|string',
        ]);

        $department = Department::find($this->id);
        $department->name = $this->name;
        $department->save();
        toastr()->success('User updated successfully');
        $this->dispatch('pg:eventRefresh-default');
        $this->closeModal();
    }
}
