<?php

use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('programs')->insert([
            ['name' => 'Computer Science'],
            ['name' => 'Medical Sciences'],
            ['name' => 'Management Sciences'],
            ['name' => 'Art & Design']
        ]);
    }

}
