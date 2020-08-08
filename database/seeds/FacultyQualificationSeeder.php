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
            ['name' => 'PhD'],
            ['name' => '18 years education (MS/MPhil/MBA/MPA/M.Com)'],
            ['name' => '16 years education (Bachelors/Masters)'],
            ['name' => 'Others (professional/industry experience)'],
        ]);
    }
}
