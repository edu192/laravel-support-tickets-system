<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    : bool
    {
        return false;
    }

    public function view(User $user, Ticket $ticket)
    : bool
    {
        return $user->id === $ticket->user_id;
    }

    public function create(User $user)
    : bool
    {
    }

    public function update(User $user, Ticket $ticket)
    : bool
    {
    }

    public function delete(User $user, Ticket $ticket)
    : bool
    {
        return $ticket->status==0 && $user->id === $ticket->user_id;
    }

    public function restore(User $user, Ticket $ticket)
    : bool
    {
    }

    public function forceDelete(User $user, Ticket $ticket)
    : bool
    {
    }

    public function post_comment(User $user, Ticket $ticket)
    : bool
    {
        if ($ticket->status !== 2) {
            $participantIds = $ticket->assigned_agent->pluck('id')->toArray();
            if ($user->id === $ticket->user_id || in_array($user->id, $participantIds)) {
                return true;
            }
        }
        return false;
    }
}
