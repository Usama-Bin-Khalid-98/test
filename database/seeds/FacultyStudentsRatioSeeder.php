<?php

use Illuminate\Database\Seeder;

class FacultyStudentsRatioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('faculty_student_ratio')->insert([
            ['campus_id' => '209',
            'program_id' => '2',
            'total_enrollments' => '400',
            'status' => 'active',
            ],
             ['campus_id' => '209',
            'program_id' => '17',
            'total_enrollments' => '200',
            'status' => 'active',
            ],
             ['campus_id' => '209',
            'program_id' => '13',
            'total_enrollments' => '60',
            'status' => 'active',
            ]
        ]);


    }

}
