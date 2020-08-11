<?php

use Illuminate\Database\Seeder;

class InternalCommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('internal_communities')->insert(['campus_id'=>'1','welfare_program_id'=>'1','no_of_individual_covered'=>'12','file'=>'zip.docx','status'=>'active','isComplete'=>'yes','created_by'=>'1']);
    }
}
