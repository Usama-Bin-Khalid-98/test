<?php

use Illuminate\Database\Seeder;

class NbeacCriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nbeac_criterias')->insert([
            ['editor1' => 'At least 3 batches of the degree should have passed to consider the program for accreditation',
             'editor2' => 'Vision and mission should exist, realistic and shared among the all stake holders. Mission statement of business school is clear, current and aligned with its vision statement.',
             'editor3' => 'Strategic Plan should exist for 03-05 years',
             'editor4' => '',
             'editor5' => 'Class Size',
             'editor6' => 'Following is the recommended Course load',
             'editor7' => '',
             'editor8' => 'Bandwidth Internet service (desirable) = 1 MB access rate',
             'editor9' => 'Student to Computer ratio: 1:20',
        ],
        ]);
    }
}
