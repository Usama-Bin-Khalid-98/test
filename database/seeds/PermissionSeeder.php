<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permissions Seeder
        DB:table('permissions')->insert([
            ['name' => 'role-list', 'guard_name' => 'web'],
            ['name' => 'role-create','guard_name' => 'web'],
            ['name' => 'role-edit','guard_name' => 'web'],
            ['name' => 'role-delete','guard_name' => 'web'],
            ['name' => 'product-list','guard_name' => 'web'],
            ['name' => 'product-create','guard_name' => 'web'],
            ['name' => 'product-edit','guard_name' => 'web'],
            ['name' => 'product-delete','guard_name' => 'web']
        ]
    );

    }
}
