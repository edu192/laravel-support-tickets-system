<?php

namespace App\Livewire\Backend\Department;

use App\Models\Department;
use LivewireUI\Modal\ModalComponent;

class DeleteModal extends ModalComponent
{
    public int $department_id;
    public function render()
    {
        $this->authorize('create', Department::class);
        return view('livewire.backend.department.delete-modal');
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
