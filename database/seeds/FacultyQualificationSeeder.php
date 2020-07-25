<?php

use Illuminate\Database\Seeder;

class FacultyQualificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('faculty_qualifications')->insert([
            ['qualification' => '18 years education (MS/MPhil/MBA/MPA/M.Com)'],
            ['qualification' => '16 years education (Bachelors/Masters)'],
            ['qualification' => 'Others (professional/industry experience)'],
        ]);
    }
}
