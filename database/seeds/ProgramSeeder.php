<?php

use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('programs')->insert([
            ['name' => 'BS COMMERECE'],
            ['name' => 'B.Sc(hons)'],
            ['name' => 'BBA'],
            ['name' => 'BBA (Healthcare Management)'],
            ['name' => 'BBA (hons) Banking & Finance'],
            ['name' => 'BBA (hons.)'],
            ['name' => 'BBA Agribusiness'],
            ['name' => 'BBA(hons) Industrial Management'],
            ['name' => 'BBIT'],
            ['name' => 'BBS(Bachelors in Business Studies)'],
            ['name' => 'BEC (Bachelors of Economics)'],
            ['name' => 'BS (hons) in Management Science'],
            ['name' => 'BS (Public Administration)'],
            ['name' => 'BS Accounting and Finance'],
            ['name' => 'BSBA'],
            ['name' => 'BSc (hons) Accounting & Finance'],
            ['name' => 'BSc (hons) Management Science'],
            ['name' => 'Bsc in Management Sciences'],
            ['name' => 'Executive MBA'],
            ['name' => 'M.Com'],
            ['name' => 'MBA'],
            ['name' => 'MBA Banking & Finance'],
            ['name' => 'MBA Industrial Management'],
            ['name' => 'MBF (Master of Banking & Finance)'],
            ['name' => 'MPA'],
            ['name' => 'MS'],
            ['name' => 'MS Banking and Finance'],
            ['name' => 'MS General Management'],
            ['name' => 'MS Project Management'],
             ['name' => 'MS/MPhil'],
              ['name' => 'MSC (Accounting and Finance)'],
               ['name' => 'PHD']

           
        ]);
    }

}
