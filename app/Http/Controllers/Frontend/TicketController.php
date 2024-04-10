<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
    }

    public function store(Request $request)
    {
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

    public function show(Ticket $ticket)
    {
        $this->authorize('view', $ticket);
        return view('frontend.ticket.show', compact('ticket'));
    }

    public function closed_tickets()
    {
        return view('frontend.ticket.closed');
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
