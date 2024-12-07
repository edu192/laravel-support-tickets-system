<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    : void
    {
        if (DB::table('categories')->count() <= 0) {
            $categories = [
                //Soporte Técnico
                [
                    'name' => 'Instalación de Software',
                    'department_id' => 1,
                ],
                [
                    'name' => 'Reparación de Hardware',
                    'department_id' => 1,
                ],
                [
                    'name' => 'Problemas de Red',
                    'department_id' => 1,
                ],
                [
                    'name' => 'Restablecimiento de Contraseña',
                    'department_id' => 1,
                ],
                [
                    'name' => 'Actualización del Sistema',
                    'department_id' => 1,
                ],
                //Facturación
                [
                    'name' => 'Facturación',
                    'department_id' => 2,
                ],
                [
                    'name' => 'Problemas de Pago',
                    'department_id' => 2,
                ],
                [
                    'name' => 'Reembolsos',
                    'department_id' => 2,
                ],
                [
                    'name' => 'Actualizaciones de Cuenta',
                    'department_id' => 2,
                ],
                [
                    'name' => 'Consultas de Facturación',
                    'department_id' => 2,
                ],
                //Ventas
                [
                    'name' => 'Generación de Leads',
                    'department_id' => 3,
                ],
                [
                    'name' => 'Relación con el Cliente',
                    'department_id' => 3,
                ],
                [
                    'name' => 'Informes de Ventas',
                    'department_id' => 3,
                ],
                [
                    'name' => 'Conocimiento del Producto',
                    'department_id' => 3,
                ],
                [
                    'name' => 'Capacitación en Ventas',
                    'department_id' => 3,
                ],
                //Atención al Cliente
                [
                    'name' => 'Consultas sobre Productos',
                    'department_id' => 4,
                ],
                [
                    'name' => 'Estado del Pedido',
                    'department_id' => 4,
                ],
                [
                    'name' => 'Problemas de Envío',
                    'department_id' => 4,
                ],
                [
                    'name' => 'Devoluciones e Intercambios',
                    'department_id' => 4,
                ],
                [
                    'name' => 'Comentarios',
                    'department_id' => 4,
                ],
                //Recursos Humanos
                [
                    'name' => 'Beneficios',
                    'department_id' => 5,
                ],
                [
                    'name' => 'Reclutamiento',
                    'department_id' => 5,
                ],
                [
                    'name' => 'Relaciones Laborales',
                    'department_id' => 5,
                ],
                [
                    'name' => 'Capacitación',
                    'department_id' => 5,
                ],
                [
                    'name' => 'Nómina',
                    'department_id' => 5,
                ],
                //Marketing
                [
                    'name' => 'Redes Sociales',
                    'department_id' => 6,
                ],
                [
                    'name' => 'Email Marketing',
                    'department_id' => 6,
                ],
                [
                    'name' => 'SEO',
                    'department_id' => 6,
                ],
                [
                    'name' => 'Creación de Contenido',
                    'department_id' => 6,
                ],
                [
                    'name' => 'Investigación de Mercado',
                    'department_id' => 6,
                ],
                //Gestión de Producto
                [
                    'name' => 'Desarrollo de Producto',
                    'department_id' => 7,
                ],
                [
                    'name' => 'Lanzamiento de Producto',
                    'department_id' => 7,
                ],
                [
                    'name' => 'Comentarios sobre el Producto',
                    'department_id' => 7,
                ],
                [
                    'name' => 'Actualizaciones del Producto',
                    'department_id' => 7,
                ],
                [
                    'name' => 'Capacitación en Producto',
                    'department_id' => 7,
                ],
            ];
            DB::table('categories')->insert($categories);
        }
    }
}
