<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFacultyPortfolioToNbeacCriterias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nbeac_criterias', function (Blueprint $table) {
            //
            $table->text('faculty_portfolio')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nbeac_criterias', function (Blueprint $table) {
            //
        });
    }
}
