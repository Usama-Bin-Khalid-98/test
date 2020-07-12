<?php

use Illuminate\Database\Seeder;

class BusinessSchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('business_schools')->insert([

                ['name' => 'City University of Science & Technology Peshawar', 'status' => 'active'],
                ['name' => 'Abasyn University Peshawar', 'status' => 'active'],
                ['name' => 'Capital University of Science & Technology', 'status' => 'active'],
                ['name' => 'Quaid-i-Azam University', 'status' => 'active'],
                ['name' => 'Pakistan Institute of Engineering and Applied Sciences', 'status' => 'active'],
                ['name' => 'National Defence University, Pakistan', 'status' => 'active'],
                ['name' => 'Allama Iqbal Open University', 'status' => 'active']
            ]
        );
    }
}
