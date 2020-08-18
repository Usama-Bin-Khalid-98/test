<?php

use Illuminate\Database\Seeder;

class ScopeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('scopes')->insert([
            ['campus_id'=>'1','program_id'=>'1','level_id'=>'1','date_program'=>'2000-2-21','status'=>'active','isComplete'=>'yes','created_by'=>'1'],
            ['campus_id'=>'209','program_id'=>'1','level_id'=>'1','date_program'=>'2000-2-21','status'=>'active','isComplete'=>'yes','created_by'=>'1'],
            ['campus_id'=>'209','program_id'=>'3','level_id'=>'1','date_program'=>'2000-2-21','status'=>'active','isComplete'=>'yes','created_by'=>'1'],
        );
    }
}
