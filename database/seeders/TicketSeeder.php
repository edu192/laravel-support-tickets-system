<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class TicketSeeder extends Seeder
{
    public function run()
    : void
    {
        $departments = Department::with(['categories', 'users'])->get();
        Ticket::withoutEvents(function () use ($departments) {
            User::where('type', 1)->get()->each(function ($user) use ($departments) {
                Ticket::factory(6)->create([
                    'user_id' => $user->id,
                    'status' => 0,
                ])->each(function ($ticket) use ($departments) {
                    $ticket->category_id = $departments->random()->categories->random()->id;
                    $ticket->save();
                });
            });
            Ticket::inRandomOrder()->take(200)->get()->each(function ($ticket) use ($departments) {
                $ticket->status = 1;
                $ticket->assigned_agent()->attach($ticket->category->department->users->random());
                Log::info('TicketSeeder: Updated status to 1 for ticket id: ' . $ticket->id);
                $ticket->save();
            });
            Ticket::whereDoesntHave('assigned_agent')->take(50)->get()->each(function ($ticket) use ($departments) {
                $ticket->assigned_agent()->attach($ticket->category->department->users->random());
                $ticket->status = 2;
                Log::info('TicketSeeder: Updated status to 2 for ticket id: ' . $ticket->id);
                $ticket->save();
            });
        });
        ;
    }
}
