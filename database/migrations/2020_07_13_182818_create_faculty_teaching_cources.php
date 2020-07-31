<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultyTeachingCources extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_teaching_cources', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('campus_id')->unsigned()->nullable();
            $table->foreign('campus_id')
                ->references('id')
                ->on('campuses');
            $table->integer('lookup_faculty_type_id')->unsigned();
            $table->foreign('lookup_faculty_type_id')
                ->references('id')
                ->on('lookup_faculty_types');
            $table->integer('designation_id')->unsigned();
            $table->foreign('designation_id')
                ->references('id')
                ->on('designations');
            $table->integer('max_cources_allowed');
            $table->integer('tc_program1');
            $table->integer('tc_program2');
            $table->enum('status',['active','inactive'])->default('active');
            $table->enum('isCompleted',['yes','no'])->default('no');
            $table->integer('created_by')->unsigned()->nullable();
            $table->foreign('created_by')
                ->references('id')
                ->on('users');
            $table->integer('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')
                ->references('id')
                ->on('users');
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->foreign('deleted_by')
                ->references('id')
                ->on('users');
            $table->timestamps();
            $table->Softdeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faculty_teaching_cources');
    }
}
