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
                ['name' => 'Fall t', 'status' => 'active'],
                ['name' => 'Spring t', 'status' => 'active'],
                ['name' => 'Fall t-1', 'status' => 'active'],
                ['name' => 'Spring t-1', 'status' => 'active'],
                ['name' => 'Fall t-2', 'status' => 'active'],
                 ['name' => 'Spring t-2', 'status' => 'active']
            ]
        );
    }
}
