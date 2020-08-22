<?php

use Illuminate\Database\Seeder;

class PublicationCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('publication_categories')->insert([
            ['name' => 'Academic research articles'],
            ['name' => 'Books'],
            ['name' => 'Other Publications'],
        ]);
    }
}
