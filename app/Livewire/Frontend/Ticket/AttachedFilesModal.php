<?php

namespace App\Livewire\Frontend\Ticket;

use App\Models\Ticket;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class AttachedFilesModal extends ModalComponent
{
    use WithFileUploads;

    public Ticket $ticket;
    public $files = [];

    public function render()
    {
        $this->authorize('view', $this->ticket);
        return view('livewire.frontend.ticket.attached-files-modal');
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
