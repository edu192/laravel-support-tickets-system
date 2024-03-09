<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    public function run()
    : void
    {
        $departments = [
            ['name' => 'Technical Support'],
            ['name' => 'Billing'],
            ['name' => 'Sales'],
            ['name' => 'Customer Service'],
            ['name' => 'Human Resources'],
            ['name' => 'Marketing'],
            ['name' => 'Product Management'],
        ];
        DB::table('departments')->insert($departments);
    }
}
