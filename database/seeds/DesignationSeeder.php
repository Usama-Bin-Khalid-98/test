<?php

use Illuminate\Database\Seeder;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('designations')->insert([
            ['name' => 'Associate Professor'],
            ['name' => 'Dean of school'],
            ['name' => 'Director'],
            ['name' => 'Head of school'],
            ['name' => 'Lecturer'],
            ['name' => 'NBEAC focal person'],
            ['name' => 'Principal'],
            ['name' => 'Professor'],
            ['name' => 'Rector'],
            ['name' => 'Research assistant'],
            ['name' => 'Vice chancellor'],
            ['name' => 'Other']
        ]);
    }
}
