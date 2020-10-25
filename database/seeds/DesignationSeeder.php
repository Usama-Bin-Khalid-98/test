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
        //
        DB::table('designations')->insert([
            ['name' => 'Associate Professor'],
            ['name' => 'Assistant Professor'],
            ['name' => 'Dean of School'],
            ['name' => 'Director'],
            ['name' => 'Head of school'],
            ['name' => 'Lecturer'],
            ['name' => 'NBEAC Focal Person'],
            ['name' => 'Other'],
            ['name' => 'Principal'],
            ['name' => 'Professor'],
            ['name' => 'Rector'],
            ['name' => 'Research Assistant'],
            ['name' => 'Vice chancellor'],
        ]);
    }
}
