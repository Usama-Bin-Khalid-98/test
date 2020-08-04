<?php

use Illuminate\Database\Seeder;

class QecTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('qec_types')->insert([
                ['name' => 'Hierarchical position', 'status' => 'active'],
                ['name' => 'Year of  establishment ', 'status' => 'active'],
                ['name' => 'Head/supervisor of the QEC office', 'status' => 'active'],
                ['name' => 'Head/Supervisor reports to', 'status' => 'active'],
                ['name' => 'Composition of QEC committee (if any)', 'status' => 'active'],
                ['name' => 'Total number of staff members', 'status' => 'active']
            ]
        );
    }
}
