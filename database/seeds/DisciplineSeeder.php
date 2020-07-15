<?php

use Illuminate\Database\Seeder;

class DisciplineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('disciplines')->insert([
            ['name' => 'Agriculture & Veterinary'],
            ['name' => 'Arts & Design'],
            ['name' => 'Business Administration'],
            ['name' => 'Commerce, Management Sciences'],
            ['name' => 'Engineering & Technology'],
            ['name' => 'Economics'],
            ['name' => 'General'],
            ['name' => 'Medical'],
            ['name' => 'Medicine and Healthcare'],
            ['name' => 'Public Administration'],
            ['name' => 'Science & Technology']
        ]);
    }
}
