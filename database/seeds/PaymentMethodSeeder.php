<?php

use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('payment_methods')->insert([
            ['name' => 'Online Bank'],
            ['name' => 'Check'],
            ['name' => 'EasyPaisa'],
            ['name' => 'PayOrder/Demand Draft']
        ]);
    }
}
