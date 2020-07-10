<?php

use Illuminate\Database\Seeder;

class DegreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('degrees')->insert([
            ['name' => 'BSSE'],
            ['name' => 'BCS'],
            ['name' => 'BBA'],
            ['name' => 'BA'],
            ['name' => 'MA'],
            ['name' => 'MSE'],
            ['name' => 'MCS'],
            ['name' => 'MBA'],
            ['name' => 'BArch'],
            ['name' => 'BAAS'],
            ['name' => 'BEng'],
            ['name' => 'BTech'],
            ['name' => 'BSBA'],
            ['name' => 'BSET'],
            ['name' => 'BMS'],
            ['name' => 'BCom'],
            ['name' => 'BSPH']
        ]);
    }
}
