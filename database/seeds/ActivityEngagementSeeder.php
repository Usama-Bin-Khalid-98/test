<?php

use Illuminate\Database\Seeder;

class ActivityEngagementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('activity_engagements')->insert([
                ['name' => 'Curriculum development', 'status' => 'active'],
                ['name' => 'Student mentoring', 'status' => 'active'],
                ['name' => 'Program delivery', 'status' => 'active'],
                ['name' => 'Industry linkages', 'status' => 'active'],
                ['name' => 'Fundraising', 'status' => 'active'],
                ['name' => 'Internships & placements', 'status' => 'active'],
                ['name' => 'Others (specify)', 'status' => 'active']
            ]
        );
    }
}
