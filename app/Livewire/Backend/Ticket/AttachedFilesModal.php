<?php

namespace App\Livewire\Backend\Ticket;

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
        return view('livewire.backend.ticket.attached-files-modal');
    }

    public static function modalMaxWidth(): string
    {
        return '2xl';
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
