<?php

namespace App\Livewire\Frontend;

use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class TicketAttachedFiles extends ModalComponent
{
    use WithFileUploads;

    public Ticket $ticket;
    public $files = [];

    public function render()
    {
        return view('livewire.frontend.ticket-attached-files');
    }

    public function save_files()
    {
        $this->validate([
            'files.*' => 'required|file|mimes:pdf,jpeg,png,jpg|max:1024',
        ]);

        foreach ($this->files as $file) {
            $new_stored_image = basename($file->store('public/uploads'));
            $this->ticket->files()->create([
                'name' => $new_stored_image,
            ]);
        }

        toastr()->success('Files uploaded successfully!');
        $this->closeModal();
    }
}
