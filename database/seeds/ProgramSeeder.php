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
            ['department_id' => 1, 'name' => 'BS COMMERECE'],
            ['department_id' => 1, 'name' => 'BBA'],
            ['department_id' => 1, 'name' => 'BBA (Healthcare Management)'],
            ['department_id' => 1, 'name' => 'BBA (hons) Banking & Finance'],
            ['department_id' => 1, 'name' => 'BBA (hons.)'],
            ['department_id' => 1, 'name' => 'BBA Agribusiness'],
            ['department_id' => 1, 'name' => 'BBA(hons) Industrial Management'],
            ['department_id' => 1, 'name' => 'BBIT'],
            ['department_id' => 1, 'name' => 'BBS(Bachelors in Business Studies)'],
            ['department_id' => 1, 'name' => 'BEC (Bachelors of Economics)'],
            ['department_id' => 1, 'name' => 'BS (hons) in Management Science'],
            ['department_id' => 1, 'name' => 'BS (Public Administration)'],
            ['department_id' => 1, 'name' => 'BS Accounting and Finance'],
            ['department_id' => 1, 'name' => 'BSBA'],
            ['department_id' => 1, 'name' => 'BSc (hons) Accounting & Finance'],
            ['department_id' => 1, 'name' => 'B.Sc(hons)'],
            ['department_id' => 1, 'name' => 'Bsc in Management Sciences'],
            ['department_id' => 1, 'name' => 'Executive MBA'],
            ['department_id' => 1, 'name' => 'M.Com'],
            ['department_id' => 1, 'name' => 'MBA'],
            ['department_id' => 1, 'name' => 'MBA Banking & Finance'],
            ['department_id' => 1, 'name' => 'MBA Industrial Management'],
            ['department_id' => 1, 'name' => 'MBF (Master of Banking & Finance)'],
            ['department_id' => 1, 'name' => 'MPA'],
            ['department_id' => 2, 'name' => 'MS'],
            ['department_id' => 2, 'name' => 'MS Banking and Finance'],
            ['department_id' => 2, 'name' => 'MS General Management'],
            ['department_id' => 2, 'name' => 'MS Project Management'],
            ['department_id' => 2, 'name' => 'MS/MPhil'],
            ['department_id' => 2, 'name' => 'MSC (Accounting and Finance)']

        ]);
    }

}
