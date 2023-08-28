<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixProgramCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('program_courses', function (Blueprint $table) {
            $table->dropForeign(['pre_req_id']);
            $table->dropColumn('pre_req_id');
            $table->string('prerequisite', 255)->nullable()->after('credit_hours');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('program_courses', function (Blueprint $table) {
            $table->dropColumn('prerequisite');
            $table->integer('pre_req_id')->unsigned();
            $table->foreign('pre_req_id')
                ->references('id')
                ->on('programs');
        });
    }
}
