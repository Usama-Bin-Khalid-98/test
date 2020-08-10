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
            ['name' => 'Head of school'],
            ['name' => 'Dean of school'],
            ['name' => 'NBEAC focal person'],
            ['name' => 'Rector'],
            ['name' => 'Vice chancellor'],
            ['name' => 'Principal'],
            ['name' => 'Director'],
            ['name' => 'Professor'],
            ['name' => 'Associate Professor'],
            ['name' => 'Assistant Professor'],
            ['name' => 'lecturer'],
            ['name' => 'research assistant'],
            ['name' => 'other']

        ]);
    }
}
