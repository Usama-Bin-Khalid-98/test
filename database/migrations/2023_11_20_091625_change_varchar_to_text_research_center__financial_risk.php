<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeVarcharToTextResearchCenterFinancialRisk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('research_centers', function (Blueprint $table) {
            $table->dropColumn('composition');
        });
        Schema::table('research_centers', function (Blueprint $table) {
            $table->text('composition')->after('reports_to');
        });
        Schema::table('financial_risks', function (Blueprint $table) {
            $table->dropColumn('remedial_measure');
        });
        Schema::table('financial_risks', function (Blueprint $table) {
            $table->text('remedial_measure')->after('stakeholder_involved');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('research_centers', function (Blueprint $table) {
            $table->dropColumn('composition');
        });
        Schema::table('financial_risks', function (Blueprint $table) {
            $table->dropColumn('remedial_measure');
        });
        Schema::table('research_centers', function (Blueprint $table) {
            $table->string('composition', 100)->after('reports_to');
        });
        Schema::table('financial_risks', function (Blueprint $table) {
            $table->string('remedial_measure', 100)->after('stakeholder_involved');
        });
    }
}
