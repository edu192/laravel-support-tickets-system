<?php

namespace App\Livewire\Frontend\Ticket;

use App\Models\Category;
use LivewireUI\Modal\ModalComponent;

class CreateModal extends ModalComponent
{
    public int $category;
    public string $title;
    public string $description;
    public int $priority;

    public function mount()
    {
        $this->category = 1;
        $this->title = '';
        $this->description = '';
        $this->priority = 0;
    }

    public function render()
    {
        return view('livewire.frontend.ticket.create-modal', [
            'categories' => Category::all(),
        ]);
    }

    public static function modalMaxWidth()
    : string
    {
        return '2xl';
    }

    public function create_ticket()
    : void
    {
        $this->validate([
            'category' => 'required|exists:categories,id|integer',
            'title' => 'required|string|max:255|min:3',
            'description' => 'required|string|max:255|min:10',
            'priority' => 'required|in:0,1,2',
        ]);

        auth()->user()->tickets()->create([
            'category_id' => $this->category,
            'title' => $this->title,
            'description' => $this->description,
            'priority' => $this->priority,
            'status' => '0',
        ]);

//        $this->emit('ticket_created');
        $this->dispatch('pg:eventRefresh-default');
        toastr()->success('Ticket created successfully!');
        $this->closeModal();
    }
}
