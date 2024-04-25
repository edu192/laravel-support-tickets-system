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
        $tickets = Ticket::whereHas('assigned_agent')->where('status', '!=', 0)->get();
        Comment::withoutEvents(function () use ($tickets) {
            $tickets->each(function ($ticket) {
                for ($i = 0; $i < 7; $i++) {
                    $commentData = Comment::factory()->make([
                        'user_id' => $i % 2 == 0 ? $ticket->user_id : $ticket->assigned_agent()->first()->id,
                    ])->toArray();
                    $ticket->comments()->create($commentData);
                }
            });
        });
    }
}
