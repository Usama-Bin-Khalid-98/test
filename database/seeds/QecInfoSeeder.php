<?php

use Illuminate\Database\Seeder;

class QecInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('quec_infos')->insert(['campus_id'=>'1','qec_type_id'=>'1','level'=>'mid','file'=>'p.pdf','status'=>'active','isComplete'=>'yes','created_by'=>'1']);
    }
}
