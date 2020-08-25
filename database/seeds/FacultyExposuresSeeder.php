<?php

use Illuminate\Database\Seeder;

class FacultyExposuresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('faculty_exposures')->insert([
            ['campus_id' => '209',
            'department_id' => '1',
            'faculty_name' => 'Alia',
            'activity' => 'ABC',
            'date' => '1-1-2020',
            'duration' => '10 Months',
            'status' => 'active',
            ],
             ['campus_id' => '209',
            'department_id' => '2',
            'faculty_name' => 'Linta',
            'activity' => 'XYZ',
            'date' => '1-1-2010',
            'duration' => '12 Months',
            'status' => 'active',
            ],
        ]);
    }
}
