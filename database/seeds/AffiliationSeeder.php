<?php

use Illuminate\Database\Seeder;

class AffiliationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   public function run()
    {
        //
        DB::table('affiliations')->insert([
        	['id'=>'1','campus_id'=>'209','name'=>'Ali','designation_id'=>'10','statutory_bodies_id'=>'1','status'=>'active','created_by'=>'1','affiliation'=>'abc'],
        	['id'=>'2','campus_id'=>'209','name'=>'Maham','designation_id'=>'3','statutory_bodies_id'=>'5','status'=>'active','created_by'=>'1','affiliation'=>'xyz'],
        ]);
    }
}
