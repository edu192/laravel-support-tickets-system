<?php

namespace App\Livewire\Backend;

use App\Models\Category;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class CategoryDeleteModal extends ModalComponent
{
    public int $id;

    public function render()
    {
        return view('livewire.backend.category-delete-modal');
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
