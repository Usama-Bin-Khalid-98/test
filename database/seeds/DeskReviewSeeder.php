<?php

use Illuminate\Database\Seeder;

class DeskReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	 DB::table('desk_reviews')->insert([
    	 	['status'=>'active']
    	 ]);
        //
    }
}
