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
        //
        DB::table('work_loads')->insert([
            ['campus_id'=>'1','faculty_name'=>'tahir','designation_id'=>'1','total_courses'=>'21','phd'=>'2','masters'=>'3','bachleors'=>'21','admin_responsibilities'=>'cook','year'=>'2003','status'=>'active','isCompleted'=>'yes','created_by'=>'1'],
            ['campus_id'=>'209','faculty_name'=>'Humaira Jabeen','designation_id'=>'1','total_courses'=>'21','phd'=>'2','masters'=>'3','bachleors'=>'21','admin_responsibilities'=>'Controller','year'=>'2003','status'=>'active','isCompleted'=>'yes','created_by'=>'1'],
            ['campus_id'=>'209','faculty_name'=>'Mahnoor Khan Swati','designation_id'=>'2','total_courses'=>'26','phd'=>'12','masters'=>'32','bachleors'=>'50','admin_responsibilities'=>'Exams Section','year'=>'2020','status'=>'active','isCompleted'=>'yes','created_by'=>'1'],
        ]);
    }
}
