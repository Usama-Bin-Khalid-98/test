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
            ['name' => 'Professor'],
            ['name' => 'Associate Professor'],
            ['name' => 'Assistant Professor'],
            ['name' => 'lecturer'],
            ['name' => 'research assistant'],
            ['name' => 'other']
            
        ]);
    }
}
