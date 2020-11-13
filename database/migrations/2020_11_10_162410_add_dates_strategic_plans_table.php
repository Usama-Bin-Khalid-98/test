<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDatesStrategicPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('strategic_plans', function (Blueprint $table){
            $table->date('plan_period_from')->after('department_id')->nullable();
            $table->date('plan_period_to')->after('plan_period_from')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('strategic_plans', function (Blueprint $table){
            $table->dropColumn('plan_period_from');
            $table->dropColumn('plan_period_to');
        });
        //
    }
}
