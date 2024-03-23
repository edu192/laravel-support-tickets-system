<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run()
    : void
    {
        // Fetch all users of type 'employee'

        $employees = User::where('type', 2)->get();

        // Create 10 tickets and assign a random employee to each one
        Ticket::factory(25)->create()->each(function ($ticket) use ($employees) {
            // Fetch a random employee
            $employee = $employees->pop();

            // Assign the employee to the ticket
            $ticket->assigned_agent()->attach($employee->id);
        });
    }
}
