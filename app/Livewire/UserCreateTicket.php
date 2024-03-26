<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class UserCreateTicket extends ModalComponent
{
    public int $category;
    public string $title;
    public string $description;

    public function mount()
    {
        $this->category = 1;
        $this->title = '';
        $this->description = '';
    }
    public function render()
    {
        return view('livewire.user-create-ticket', [
            'categories' => Category::all(),
        ]);
    }

    public static function modalMaxWidth(): string
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
        ]);

        auth()->user()->tickets()->create([
            'category_id' => $this->category,
            'title' => $this->title,
            'description' => $this->description,
            'priority' => '0',
            'status' => '0',
        ]);

//        $this->emit('ticket_created');
        $this->dispatch('pg:eventRefresh-default');
        $this->closeModal();
    }
}
