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
                //Technical Support
                [
                    'name' => 'Software Installation',
                    'department_id' => 1,
                ],
                [
                    'name' => 'Hardware Repair',
                    'department_id' => 1,
                ],
                [
                    'name' => 'Network Issues',
                    'department_id' => 1,
                ],
                [
                    'name' => 'Password Reset',
                    'department_id' => 1,
                ],
                [
                    'name' => 'System Update',
                    'department_id' => 1,
                ],
                //Billing
                [
                    'name' => 'Invoicing',
                    'department_id' => 2,
                ],
                [
                    'name' => 'Payment Issues',
                    'department_id' => 2,
                ],
                [
                    'name' => 'Refunds',
                    'department_id' => 2,
                ],
                [
                    'name' => 'Account Updates',
                    'department_id' => 2,
                ],
                [
                    'name' => 'Billing Inquiries',
                    'department_id' => 2,
                ],
                //Sales
                [
                    'name' => 'Lead Generation',
                    'department_id' => 3,
                ],
                [
                    'name' => 'Customer Relationship',
                    'department_id' => 3,
                ],
                [
                    'name' => 'Sales Reporting',
                    'department_id' => 3,
                ],
                [
                    'name' => 'Product Knowledge',
                    'department_id' => 3,
                ],
                [
                    'name' => 'Sales Training',
                    'department_id' => 3,
                ],
                //Customer Service
                [
                    'name' => 'Product Inquiries',
                    'department_id' => 4,
                ],
                [
                    'name' => 'Order Status',
                    'department_id' => 4,
                ],
                [
                    'name' => 'Shipping Issues',
                    'department_id' => 4,
                ],
                [
                    'name' => 'Returns and Exchanges',
                    'department_id' => 4,
                ],
                [
                    'name' => 'Feedback',
                    'department_id' => 4,
                ],
                //Human Resources
                [
                    'name' => 'Benefits',
                    'department_id' => 5,
                ],
                [
                    'name' => 'Recruitment',
                    'department_id' => 5,
                ],
                [
                    'name' => 'Employee Relations',
                    'department_id' => 5,
                ],
                [
                    'name' => 'Training',
                    'department_id' => 5,
                ],
                [
                    'name' => 'Payroll',
                    'department_id' => 5,
                ],
                //Marketing
                [
                    'name' => 'Social Media',
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
                    'name' => 'Content Creation',
                    'department_id' => 6,
                ],
                [
                    'name' => 'Market Research',
                    'department_id' => 6,
                ],
                //Product Management
                [
                    'name' => 'Product Development',
                    'department_id' => 7,
                ],
                [
                    'name' => 'Product Launch',
                    'department_id' => 7,
                ],
                [
                    'name' => 'Product Feedback',
                    'department_id' => 7,
                ],
                [
                    'name' => 'Product Updates',
                    'department_id' => 7,
                ],
                [
                    'name' => 'Product Training',
                    'department_id' => 7,
                ],
            ];
            DB::table('categories')->insert($categories);
        }
    }
}
