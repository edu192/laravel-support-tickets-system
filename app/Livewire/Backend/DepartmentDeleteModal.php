<?php

namespace App\Livewire\Backend;

use App\Models\Department;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DepartmentDeleteModal extends ModalComponent
{
    public int $department_id;
    public function render()
    {
        return view('livewire.backend.department-delete-modal');
    }

    public function delete()
    {
        $department = Department::find($this->department_id);
        $department->delete();
        toastr()->success('Department deleted successfully');
        $this->dispatch('pg:eventRefresh-default');
        $this->closeModal();
    }
}
