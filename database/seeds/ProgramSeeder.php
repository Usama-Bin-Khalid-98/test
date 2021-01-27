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
            ['discipline_id' => 1, 'name' => 'BS COMMERECE'],
            ['discipline_id' => 1, 'name' => 'BBA'],
            ['discipline_id' => 1, 'name' => 'BBA (Healthcare Management)'],
            ['discipline_id' => 1, 'name' => 'BBA (hons) Banking & Finance'],
            ['discipline_id' => 1, 'name' => 'BBA (hons.)'],
            ['discipline_id' => 1, 'name' => 'BBA Agribusiness'],
            ['discipline_id' => 1, 'name' => 'BBA(hons) Industrial Management'],
            ['discipline_id' => 1, 'name' => 'BBIT'],
            ['discipline_id' => 1, 'name' => 'BBS(Bachelors in Business Studies)'],
            ['discipline_id' => 1, 'name' => 'BEC (Bachelors of Economics)'],
            ['discipline_id' => 1, 'name' => 'BS (hons) in Management Science'],
            ['discipline_id' => 1, 'name' => 'BS (Public Administration)'],
            ['discipline_id' => 1, 'name' => 'BS Accounting and Finance'],
            ['discipline_id' => 1, 'name' => 'BSBA'],
            ['discipline_id' => 1, 'name' => 'BSc (hons) Accounting & Finance'],
            ['discipline_id' => 1, 'name' => 'B.Sc(hons)'],
            ['discipline_id' => 1, 'name' => 'Bsc in Management Sciences'],
            ['discipline_id' => 1, 'name' => 'Executive MBA'],
            ['discipline_id' => 1, 'name' => 'M.Com'],
            ['discipline_id' => 1, 'name' => 'MBA'],
            ['discipline_id' => 1, 'name' => 'MBA Banking & Finance'],
            ['discipline_id' => 1, 'name' => 'MBA Industrial Management'],
            ['discipline_id' => 1, 'name' => 'MBF (Master of Banking & Finance)'],
            ['discipline_id' => 1, 'name' => 'MPA'],
            ['discipline_id' => 2, 'name' => 'MS'],
            ['discipline_id' => 2, 'name' => 'MS Banking and Finance'],
            ['discipline_id' => 2, 'name' => 'MS General Management'],
            ['discipline_id' => 2, 'name' => 'MS Project Management'],
            ['discipline_id' => 2, 'name' => 'MS/MPhil'],
            ['discipline_id' => 2, 'name' => 'MSC (Accounting and Finance)']

        ]);
    }

}
