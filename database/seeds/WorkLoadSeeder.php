<?php

use Illuminate\Database\Seeder;

class WorkLoadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('work_loads')->insert(['campus_id'=>'1','faculty_name'=>'tahir','designation_id'=>'1','total_courses'=>'21','phd'=>'2','masters'=>'3','bachleors'=>'21','admin_responsibilities'=>'cook','year'=>'2003','status'=>'active','isCompleted'=>'yes','created_by'=>'1']);
    }
}
