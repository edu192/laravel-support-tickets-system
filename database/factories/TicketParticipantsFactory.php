<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TicketParticipantsFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition()
    : array
    {
        return [
            'user_id' => User::query()->where('type', 2)->inRandomOrder()->first()->id,
            'ticket_id' => Ticket::query()->inRandomOrder()->first()->id,
        ];
    }
}
