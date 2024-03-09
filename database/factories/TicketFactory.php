<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition()
    : array
    {
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->text(),
            //status must only return numbers between 0 and 2
            'status' => $this->faker->numberBetween(0, 2),
            'priority' => $this->faker->numberBetween(0, 2),
            'user_id' => User::query()->where('type', 0)->inRandomOrder()->first()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
