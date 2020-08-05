<?php

use Illuminate\Database\Seeder;

class StaffCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('staff_categories')->insert([
                ['name' => 'Administration', 'status' => 'active'],
                ['name' => 'Laboratories', 'status' => 'active'],
                ['name' => 'Libraries', 'status' => 'active'],
                ['name' => 'Examination Office', 'status' => 'active'],
                ['name' => 'Admission office', 'status' => 'active'],
                ['name' => 'Student affairs', 'status' => 'active'],
                ['name' => 'Placement Office', 'status' => 'active'],
                ['name' => 'Research Center', 'status' => 'active'],
                ['name' => 'Others', 'status' => 'active']
            ]
        );
    }
}
