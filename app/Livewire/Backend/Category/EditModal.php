<?php

namespace App\Livewire\Backend\Category;

use App\Models\Category;
use LivewireUI\Modal\ModalComponent;

class EditModal extends ModalComponent
{
    public int $id;
    public string $name = '';
    public int $department_id = 1;
    public function render()
    {
        $this->authorize('create', Category::class);
        return view('livewire.backend.category.edit-modal',['departments'=>\App\Models\Department::all()]);
    }

    public function mount($id)
    {
        $category = \App\Models\Category::find($id);
        $this->id = $category->id;
        $this->name = $category->name;
        $this->department_id = $category->department_id;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'department_id' => 'required|integer|exists:departments,id',
        ]);
        $category = \App\Models\Category::find($this->id);
        $category->name = $this->name;
        $category->department_id = $this->department_id;
        $category->save();
        toastr()->success('Category updated successfully');
        $this->dispatch('pg:eventRefresh-default');
        $this->closeModal();
    }
}
