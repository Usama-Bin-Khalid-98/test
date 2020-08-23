<?php

use Illuminate\Database\Seeder;

class FacultyConsultancyProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('faculty_consultancy_projects')->insert([
            ['campus_id' => '209',
            'department_id' => '1',
            'faculty_name' => 'Ali Khan',
            'project_name' => 'XYZ',
            'client_name' => 'Abbas',
            'start_date' => '1-1-2020',
            'end_date' => '5-5-2020',
            'all_participants' => '1200',            
            'status' => 'active',
            ],
            ['campus_id' => '209',
            'department_id' => '2',
            'faculty_name' => 'Maham',
            'project_name' => 'ABC',
            'client_name' => 'Mahnoor',
            'start_date' => '1-1-2020',
            'end_date' => '5-5-2020',
            'all_participants' => '500',            
            'status' => 'active',
            ],
 			
            


        ]);
    }
}
