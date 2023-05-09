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
        
        Schema::table('application_receiveds', function (Blueprint $table) {
            $table->string('semester', 10);
        });

        Schema::table('mission_visions', function (Blueprint $table) {
            $table->string('mission_url', 255);
        });

        Schema::table('nbeac_criterias', function (Blueprint $table) {
            $table->text('faculty_portfolio')->nullable();
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

        Schema::table('application_receiveds', function (Blueprint $table) {
            $table->dropColumn('semester');
        });

        Schema::table('mission_visions', function (Blueprint $table) {
            $table->dropColumn('mission_url');
        });

        Schema::table('nbeac_criterias', function (Blueprint $table) {
            $table->dropColumn('faculty_portfolio');
        });

        DB::statement("ALTER TABLE slips MODIFY COLUMN status ENUM('active', 'inactive', 'pending', 'paid', 'approved') NOT NULL;");
    }
}
