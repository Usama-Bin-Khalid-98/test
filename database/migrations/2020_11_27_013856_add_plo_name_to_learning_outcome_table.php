<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPloNameToLearningOutcomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('learning_outcomes', function (Blueprint $table) {
            //
            $table->string('plo_name', 100)->after('department_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('learning_outcomes', function (Blueprint $table) {
            //
            $table->dropColumn('plo_name')->after('department_id');
        });
    }
}
