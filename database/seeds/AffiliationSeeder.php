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
        	['name'=>'Ali','campus_id'=>209,'department_id'=>1,'affiliation'=>'HEC','designation_id'=>10,'statutory_bodies_id'=>'1','status'=>'active','created_by'=>1],
        	['name'=>'Maham','campus_id'=>209,'department_id'=>1,'affiliation'=>'HEC','designation_id'=>3,'statutory_bodies_id'=>'5','status'=>'active','created_by'=>1],
        ]);
    }
}
