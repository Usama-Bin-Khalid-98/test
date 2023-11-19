<?php

use Illuminate\Database\Seeder;

class NbeacBasicInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('nbeac_basic_infos')->insert(
            [
                'name' => 'National Business Education Accreditation Council',
                'short_name' => 'NBEAC',
                'email' => 'stufail@nbeac.org.pk',
                'phone1' => '051-9080-0206-09',
                'phone2' => '051-90800208',
                'fax' => '+92 51 9080 0206-09',
                'address' => 'National Business Education Accreditation Council (NBEAC), 201, 2nd Floor, HRD Building, Higher Education Commission, H-8, Islamabad',
                'website' => 'https://www.nbeac.org.pk/',
                'director' => 'Mr. Ahtesham Ali Raja',
                'chairman' => 'Dr. Naukhez Sarwar',
                'user_id' => 1,

            ]
        );
    }
}
