<?php

use Illuminate\Database\Seeder;

class MissionVisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {DB::table('mission_visions')->insert([
    	  	['campus_id'=>'1','mission'=>'seek the light and spread it','vision'=>'mrsskl','file'=>'zsss.pdf','status'=>'active','isComplete'=>'yes','created_by'=>'1']
    	  ]);
        //
    }
}
