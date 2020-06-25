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
                ['name' => 'City University of Science & Technology Peshawar', 'status' => 'enabled'],
                ['name' => 'Abasyn University Peshawar', 'status' => 'enabled'],
                ['name' => 'Capital University of Science & Technology', 'status' => 'enabled'],
                ['name' => 'Quaid-i-Azam University', 'status' => 'enabled'],
                ['name' => 'Pakistan Institute of Engineering and Applied Sciences', 'status' => 'enabled'],
                ['name' => 'National Defence University, Pakistan', 'status' => 'enabled'],
                ['name' => 'Allama Iqbal Open University', 'status' => 'enabled']
            ]
        );
    }
}
