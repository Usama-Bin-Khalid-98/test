<?php

use Illuminate\Database\Seeder;

class FacultyWorkshopsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('faculty_workshops')->insert([
            ['campus_id' => '209',
            'department_id' => '1',
            'date' => '12-12-2020', 
            'venue' => 'Islamabad',
            'title' => 'XYZ', 
            'faculty_trainer_name' => 'Imran Khan',
            'participants' => '1200',            
            'status' => 'active',
            ],
 			 ['campus_id' => '209',
            'department_id' => '2',
            'date' => '1-1-2020', 
            'venue' => 'Peshawar',
            'title' => 'ABC', 
            'faculty_trainer_name' => 'Ali Zafar',
            'participants' => '900',            
            'status' => 'active',
            ],
            


        ]);
    }
}
