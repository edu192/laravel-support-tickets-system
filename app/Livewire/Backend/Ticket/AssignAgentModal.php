<?php

namespace App\Livewire\Backend\Ticket;

use App\Models\Ticket;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class AssignAgentModal extends ModalComponent
{
    public Ticket $ticket;
    public int $agent_id;

    public function render()
    {
        $agents = User::where('type', '2')->where('department_id', $this->ticket->category->department->id)->get();
        $this->agent_id = !empty($agents) ? $agents->first()->id : 0;
        $assigned_agents = Ticket::where('id', $this->ticket->id)->first()->assigned_agent;
        return view('livewire.backend.ticket.assign-agent-modal', ['agents' => $agents, 'assigned_agents' => $assigned_agents]);
    }



    public function assign()
    {
        $this->validate([
            'agent_id' => 'required|integer|exists:users,id',
        ]);
        $ticket = Ticket::find($this->ticket->id);
        $ticket->assigned_agent()->sync([$this->agent_id], false);
        $ticket->save();
        toastr()->success('Ticket assigned successfully');
        $this->dispatch('pg:eventRefresh-default');
        $this->closeModal();
    }


    public function remove_agent($agent_id)
    {
        $ticket = Ticket::find($this->ticket->id);
        $ticket->assigned_agent()->detach($agent_id);
        $ticket->save();
        toastr()->success('Agent removed successfully');
        $this->dispatch('pg:eventRefresh-default');
    }


}
