<?php

use Illuminate\Database\Seeder;

class CurriculumReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('curriculum_reviews')->insert([
            ['campus_id' => '209',
            'review_meeting' => 'Yes',
            'date' => '16-12-2020',
            'composition' => 'XYZ',
            'reviewer_names' => 'Ali, Imran, Asad',
            'designation_id' => '1',
            'affiliations_id' => '2',
            'status' => 'active',
            ],
 			['campus_id' => '209',
            'review_meeting' => 'Yes',
            'date' => '19-1-2020',
            'composition' => 'ASASA',
            'reviewer_names' => 'Huma, Saad, Asad',
            'designation_id' => '3',
            'affiliations_id' => '1',
            'status' => 'active',
            ],
            


        ]);
    }
}
