<?php

use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('semesters')->insert([

                ['name' => 'Fall', 'status' => 'active'],
                ['name' => 'Spring', 'status' => 'active'],
                ['name' => 'Fall_t', 'status' => 'active']
            ]
        );
    }
}
