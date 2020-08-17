<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('faculty_stability')->insert([
            ['campus_id' => '209',
            'total_faculty' => '100',
            'year' => '2020',
            'resigned' => '4',
            'retired' => '3',
            'terminated' => '2',
            'new_induction' => '12',
            'status' => 'active',
            ],
            ['campus_id' => '209',
            'total_faculty' => '120',
            'year' => '2019',
            'resigned' => '2',
            'retired' => '5',
            'terminated' => '1',
            'new_induction' => '12',
            'status' => 'active',
            ],
            


        ]);

   
    }

}
