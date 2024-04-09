<?php

namespace App\Livewire\Backend\Category;

use App\Models\Category;
use LivewireUI\Modal\ModalComponent;

class DeleteModal extends ModalComponent
{
    public int $id;

    public function render()
    {
        $this->authorize('create', Category::class);
        return view('livewire.backend.category.delete-modal');
    }

    public function delete()
    {
        $category = Category::find($this->id);
        $category->delete();
        toastr()->success('Category deleted successfully');
        $this->dispatch('pg:eventRefresh-default');
        $this->closeModal();
    }
}
