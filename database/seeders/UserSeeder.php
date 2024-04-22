<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    : void
    {
        User::factory(50)->create(['type' => 1]);
        $departments = Department::all();
        User::factory(30)->create(['type' => 2])->each(function ($user) use ($departments) {
            $user->department_id = $departments->random()->id;
            $user->save();
        });

    }
}
