<?php

use Illuminate\Database\Seeder;

class InternationalFacultiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('international_faculties')->insert([
            ['campus_id' => '209',
            'department_id' => '1',
            'faculty_name' => 'Hakeem', 
            'association' => 'XYZ',
            'time_periods' => '10 Months',                        
            'status' => 'active',
            ],
              ['campus_id' => '209',
            'department_id' => '2',
            'faculty_name' => 'Nabeel', 
            'association' => 'ABC',
            'time_periods' => '12 Months',                        
            'status' => 'active',
            ],
 			 
            


        ]);
    }
}
