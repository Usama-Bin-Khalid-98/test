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
<<<<<<< HEAD
            ['qualification' => '18 years education (MS/MPhil/MBA/MPA/M.Com)'],
            ['qualification' => '16 years education (Bachelors/Masters)'],
            ['qualification' => 'Others (professional/industry experience)'],
=======
            ['name' => 'PhD'],
            ['name' => '18 years education (MS/MPhil/MBA/MPA/M.Com)'],
            ['name' => '16 years education (Bachelors/Masters)'],
            ['name' => 'Others (professional/industry experience)'],
>>>>>>> fb5ba0be3d2c2c24a2617060c6f106a0c26b7269
        ]);
    }
}
