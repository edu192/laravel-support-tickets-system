<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        return view('backend.ticket.index');
    }

    public function assigned_tickets()
    {
        return view('backend.ticket.agent.index');
    }

    public function view(Ticket $ticket)
    {
        return view('backend.ticket.comments', compact('ticket'));
    }
    public function post_comment(Request $request, Ticket $ticket)
    {
        $this->authorize('post_comment', $ticket);
        $request->validate([
            'comment' => 'required|string|min:5,max:255'
        ]);
        $ticket->comments()->create([
            'description' => $request->comment,
            'user_id' => auth()->user()->id
        ]);
        return back();
    }
    public function unassigned(){
        return view('backend.ticket.unassigned-table');
    }
}
