<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    : void
    {
        User::firstOrCreate(
            [
                'email' => 'admin@gmail.com'
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => 'password',
                'type' => 0,
                'phone' => '1234567890',
                'address' => 'Lima - Peru',
                'image' => 'https://via.placeholder.com/150',
                'department_id' => null,

            ]
        );
        User::factory(50)->create();
        User::factory(30)->create(['type' => 2]);

    }
}
