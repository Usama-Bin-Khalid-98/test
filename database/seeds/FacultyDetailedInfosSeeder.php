<?php

use Illuminate\Database\Seeder;

class FacultyDetailedInfosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faculty_detailed_infos')->insert([
            ['campus_id' => '209',
            'designation_id' => '10',
            'lookup_faculty_type_id' => '1', 
            'degree_id' => '6',
            'department_id' => '1', 
            'course_type_id' => '1',
            'awarding_institute' => 'COMSATS', 
            'country' => 'Pakistan',
            'name' => 'Usman Khalid', 
            'cnic' => '12021-7351723-7',
            'hec_experience' => '9',
            'current_job_duration' => '3',            
            'status' => 'active',
            ],
            ['campus_id' => '209',
            'designation_id' => '8',
            'lookup_faculty_type_id' => '2', 
            'degree_id' => '4',
            'department_id' => '3', 
            'course_type_id' => '3',
            'awarding_institute' => 'NUST', 
            'country' => 'Pakistan',
            'name' => 'Omer Khan', 
            'cnic' => '42322-43432342-7',
            'hec_experience' => '3',
            'current_job_duration' => '2',            
            'status' => 'active',
            ],
 			  
            


        ]);
    }
}
