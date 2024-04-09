<?php

namespace App\Livewire\Backend\Category;

use App\Models\Category;
use LivewireUI\Modal\ModalComponent;

class CreateModal extends ModalComponent
{
    public string $name = '';
    public int $department_id = 1;
    public function render()
    {
        $this->authorize('create', Category::class);
        return view('livewire.backend.category.create-modal',['departments'=>\App\Models\Department::all()]);
    }

    public function create()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'department_id' => 'required|integer|exists:departments,id',
        ]);
        $category = new Category();
        $category->name = $this->name;
        $category->department_id = $this->department_id;
        $category->save();
        toastr()->success('Category created successfully');
        $this->dispatch('pg:eventRefresh-default');
        $this->closeModal();
    }
}
