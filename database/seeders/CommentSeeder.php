<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run()
    : void
    {
        $tickets = Ticket::all();
        Comment::withoutEvents(function () use ($tickets) {
            $tickets->each(function ($ticket) {
                $ticket->comments()->createMany([
                    [
                        'user_id' => $ticket->user_id,
                        'description' => fake()->sentence(15),
                    ],
                    [
                        'user_id' => $ticket->assigned_agent()->first()->id,
                        'description' => fake()->sentence(15),
                    ],
                    [
                        'user_id' => $ticket->user_id,
                        'description' => fake()->sentence(15),
                    ],
                ]);
            });
        });
    }
}
