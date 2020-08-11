<?php

use Illuminate\Database\Seeder;

class SupportStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('support_staff')->insert(['campus_id'=>'1','staff_category_id'=>'1','total_staff'=>'21','supervisor_qualification'=>'phd','status'=>'active','isComplete'=>'yes','created_by'=>'1',]);
    }
}
