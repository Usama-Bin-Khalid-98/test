<?php

use Illuminate\Database\Seeder;

class FacultySummarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faculty_summaries')->insert([
            ['campus_id' => '209',
            'faculty_qualification_id' => '3',
            'discipline_id' => '1',
            'number_faculty' => '25',            
            'status' => 'active',
            ],
             ['campus_id' => '209',
            'faculty_qualification_id' => '2',
            'discipline_id' => '1',
            'number_faculty' => '12',
            
            'status' => 'active',
            ],
             ['campus_id' => '209',
            'faculty_qualification_id' => '4',
            'discipline_id' => '1',
            'number_faculty' => '13',
            
            'status' => 'active',
            ],
             ['campus_id' => '209',
            'faculty_qualification_id' => '1',
            'discipline_id' => '1',
            'number_faculty' => '6',
            
            'status' => 'active',
            ],
             ['campus_id' => '209',
            'faculty_qualification_id' => '3',
            'discipline_id' => '2',
            'number_faculty' => '12',
            
            'status' => 'active',
            ],
             ['campus_id' => '209',
            'faculty_qualification_id' => '2',
            'discipline_id' => '2',
            'number_faculty' => '31',
            
            'status' => 'active',
            ],
             ['campus_id' => '209',
            'faculty_qualification_id' => '2',
            'discipline_id' => '3',
            'number_faculty' => '6',
            
            'status' => 'active',
            ],
             ['campus_id' => '209',
            'faculty_qualification_id' => '1',
            'discipline_id' => '4',
            'number_faculty' => '6',
            
            'status' => 'active',
            ],
             


          


        ]);
    }
}
