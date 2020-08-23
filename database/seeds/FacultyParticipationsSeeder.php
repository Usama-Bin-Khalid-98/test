<?php

use Illuminate\Database\Seeder;

class FacultyParticipationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('faculty_participations')->insert([
            ['campus_id' => '209',
            'department_id' => '1',
            'faculty_name' => 'Alia',
            'date' => '1-1-2020',
            'organization' => 'XYZ',
            'title' => 'ABC',            
            'status' => 'active',
            ],
 			['campus_id' => '209',
            'department_id' => '2',
            'faculty_name' => 'Maham',
            'date' => '1-1-2019',
            'organization' => 'jsds',
            'title' => 'dsacs',            
            'status' => 'active',
            ],

            


        ]);
    }
}
