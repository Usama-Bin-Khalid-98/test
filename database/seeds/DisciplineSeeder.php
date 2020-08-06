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
        //Business Administration, Commerce, Management Sciences, Public Administration, Economics  ///sent by client
        DB::table('disciplines')->insert([
//            ['name' => 'Agriculture & Veterinary'],
//            ['name' => 'Arts & Design'],
            ['name' => 'Business Administration'],
            ['name' => 'Commerce/Economics'],
            ['name' => 'Management Sciences'],
            ['name' => 'Public Administration'],
            ['name' => 'Other']
//            ['name' => 'Economics'],
//            ['name' => 'General'],
//            ['name' => 'Medical'],
//            ['name' => 'Medicine and Healthcare'],
//            ['name' => 'Science & Technology']
        ]);
    }
}
