<?php

use Illuminate\Database\Seeder;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specializations')->insert([
            ['name' => 'Business Intelligence'],
            ['name' => 'Business Law and Ethics'],
            ['name' => 'Cultural Diversity Management'],
            ['name' => 'Earning Management'],
            ['name' => 'Economics'],
            ['name' => 'Engineering Management'],
            ['name' => 'Entrepreneurship'],
            ['name' => 'Finance'],
            ['name' => 'Financial Economics'],
            ['name' => 'Human Resource Development'],
            ['name' => 'Human Resource Management'],
            ['name' => 'Industrial Management'],
            ['name' => 'International Trade Policy'],
            ['name' => 'Leadership'],
            ['name' => 'Management Sciences'],
            ['name' => 'Marketing'],
            ['name' => 'MIS'],
            ['name' => 'Operations Management'],
            ['name' => 'Organizational Behaviour'],
            ['name' => 'Organizational Pshycology'],
            ['name' => 'Public Administration'],
            ['name' => 'Quality Management'],
            ['name' => 'Research Methods'],
            ['name' => 'Strategic Management'],
            ['name' => 'Supply Chain Management']
        ]);
    }
}
