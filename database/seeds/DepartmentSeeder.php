<?php

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('departments')->insert([
            ['name' => 'Computer Science'],
            ['name' => 'Medical Sciences'],
            ['name' => 'Management Sciences'],
            ['name' => 'Art & Design']
        ]);
    }
}
