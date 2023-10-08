<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterClassSize extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('class_sizes', function (Blueprint $table) {
            $table->dropForeign(['semesters_id']);
            $table->dropColumn('semesters_id');
            $table->integer('year')->nullable()->after('department_id');
            $table->string('semester', 10)->nullable()->after('year');
            $table->integer('program_id')->unsigned()->nullable()->after('year');
            $table->foreign('program_id')
                ->references('id')
                ->on('programs')
                ->onDelete('cascade');
            $table->integer('size')->after('program_id');
            $table->dropColumn('program_a');
            $table->dropColumn('program_b');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('class_sizes', function (Blueprint $table) {
            $table->BigInteger('semesters_id')->unsigned()->nullable();
            $table->foreign('semesters_id')
                ->references('id')
                ->on('semesters');
            $table->dropColumn('year');
            $table->dropColumn('semester');
            $table->dropForeign(['program_id']);
            $table->dropColumn('program_id');
            $table->dropColumn('size');
            $table->integer('program_a');
            $table->integer('program_b');
        });
    }
}
