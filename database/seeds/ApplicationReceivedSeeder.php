<?php

use Illuminate\Database\Seeder;

class ApplicationReceivedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('application_receiveds')->insert([
            ['campus_id' => '209',
            'program_id' => '16',
            'semester_id' => '1',
            'app_received' => '50',
            'admission_offered' => '40',
            'student_intake' => '39',
            'degree_req' => 'F.Sc',
            'degree_awarding_criteria' => 'abc',
            'semester_comm_date' => '2020-12-12',
            'status' => 'active',
            ],
            ['campus_id' => '209',
            'program_id' => '11',
            'semester_id' => '7',
            'app_received' => '30',
            'admission_offered' => '20',
            'student_intake' => '19',
            'degree_req' => 'F.Sc',
            'degree_awarding_criteria' => 'xyz',
            'semester_comm_date' => '2019-12-12',
            'status' => 'active',
            ],


        ]);
    }
}
