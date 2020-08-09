<?php

use Illuminate\Database\Seeder;

class ContactInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	  DB::table('contact_infos')->insert([
    	  	['name'=>'tahir butt','email'=>'tahir@pieac.edu.pk','contact_no'=>'03121234321','school_contact'=>'051312211','designation_id'=>'1','status'=>'active','isComplete'=>'yes','campus_id'=>'1','focal_person'=>'trevor',]


    	  ]);
        //
    }
}
        