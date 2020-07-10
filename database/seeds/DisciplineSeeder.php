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
            ['name' => 'Anthropology'],
            ['name' => 'Archaeology'],
            ['name' => 'Economics'],
            ['name' => 'Geography'],
            ['name' => 'Political science'],
            ['name' => 'Psychology'],
            ['name' => 'Social Work'],
            ['name' => 'Biology'],
            ['name' => 'Chemistry'],
            ['name' => 'Physics'],
            ['name' => 'Computer Science'],
            ['name' => 'Mathematics'],
            ['name' => 'Statistics'],
            ['name' => 'Business Administration'],
            ['name' => 'Engineering and technology'],
            ['name' => 'Medicine and health'],
            ['name' => 'Physical Education']
        ]);
    }
}
