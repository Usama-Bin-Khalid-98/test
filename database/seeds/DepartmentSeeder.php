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
            ['name' => 'Department of Business Administration (DBA)'],
             ['name' => 'Department of Business Management (DBM)'],
              ['name' => 'Department of Management Sciences (DMS)'],
               ['name' => 'Faculty of Management Sciences (FMS)'],
                ['name' => 'Other']
                 
        ]);
    }
}
