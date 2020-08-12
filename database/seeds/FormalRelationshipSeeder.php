<?php

use Illuminate\Database\Seeder;

class FormalRelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('formal_relationships')->insert(['campus_id'=>'1','org_name'=>'orazone','mou_title'=>'maketing','signing_mou_date'=>'8/10/2020','last_activity_date'=>'7/10/2020','last_activity_desc'=>'capitalism ','status'=>'active','isComplete'=>'yes','created_by'=>'1',]);
    }
}
