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
            ['name' => 'Soporte Técnico'],
            ['name' => 'Facturación'],
            ['name' => 'Ventas'],
            ['name' => 'Atención al Cliente'],
            ['name' => 'Recursos Humanos'],
            ['name' => 'Marketing'],
            ['name' => 'Gestión de Producto'],
        ];
        DB::table('departments')->insert($departments);
    }
}
