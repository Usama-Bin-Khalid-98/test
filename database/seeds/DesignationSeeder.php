<?php

use Illuminate\Database\Seeder;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('designations')->insert([
            ['name' => 'Associate Professor', 'is_default' => true],
            ['name' => 'Assistant Professor', 'is_default' => true],
            ['name' => 'Dean of School', 'is_default' => true],
            ['name' => 'Director', 'is_default' => true],
            ['name' => 'Head of school', 'is_default' => true],
            ['name' => 'Lecturer', 'is_default' => true],
            ['name' => 'NBEAC Focal Person', 'is_default' => true],
            ['name' => 'Other', 'is_default' => true],
            ['name' => 'Principal', 'is_default' => true],
            ['name' => 'Professor', 'is_default' => true],
            ['name' => 'Rector', 'is_default' => true],
            ['name' => 'Research Assistant', 'is_default' => true],
            ['name' => 'Vice chancellor', 'is_default' => true],
        ]);
    }
}
