<?php

use Illuminate\Database\Seeder;

class FacultyMembershipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('faculty_memberships')->insert([
            ['campus_id' => '209',
            'department_id' => '1',
            'faculty_name' => 'Faham',
            'organization' => 'ABC',
            'from' => '12-12-2019',
            'to' => '12-12-2020',            
            'status' => 'active',
            ],
 			 ['campus_id' => '209',
            'department_id' => '2',
            'faculty_name' => 'Luqman',
            'organization' => 'MNB',
            'from' => '12-12-2010',
            'to' => '12-12-2015',            
            'status' => 'active',
            ],
            


        ]);
    }
}
