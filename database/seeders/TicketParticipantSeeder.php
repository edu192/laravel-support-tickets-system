<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

class TicketParticipantSeeder extends Seeder
{
    public function run()
    : void
    {
        // Fetch all users of type 'employee'
        $employees = User::where('type', 2)->get();

        // Fetch all tickets
        $tickets = Ticket::all();

        // For each employee, assign them to a random ticket
        foreach ($employees as $employee) {
            // Fetch a random ticket
            $ticket = $tickets->random();

            // Check if the user is already assigned to the ticket
            if (!$employee->assigned_tickets()->where('ticket_id', $ticket->id)->exists()) {
                // If not, assign the user to the ticket
                $employee->assigned_tickets()->attach($ticket);
            }
        }
    }
}
