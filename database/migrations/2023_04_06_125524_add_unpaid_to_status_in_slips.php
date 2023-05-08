<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddUnpaidToStatusInSlips extends Migration


{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('slips', function (Blueprint $table) {
            //
        });
        DB::statement("ALTER TABLE slips MODIFY COLUMN status ENUM('active', 'inactive', 'pending', 'paid', 'approved', 'unpaid') NOT NULL;");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('slips', function (Blueprint $table) {
            //
        });
    }
}
