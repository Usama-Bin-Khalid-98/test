<?php

use Illuminate\Database\Seeder;

class ProjectDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('project_details')->insert(['campus_id'=>'1','date'=>'8/10/2020','activity_title'=>'coldplay','file'=>'t.pdf','status'=>'active','isComplete'=>'yes']);
    }
}
