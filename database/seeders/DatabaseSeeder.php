<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
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
        $this->call(DepartmentSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TicketSeeder::class);
        $this->call(CommentSeeder::class);
    }
}
