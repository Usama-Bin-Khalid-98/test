<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultySummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_summaries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('campus_id')->unsigned()->nullable();
            $table->foreign('campus_id')
                ->references('id')
                ->on('campuses');
            $table->integer('department_id')->unsigned()->nullable();
            $table->foreign('department_id')
                ->references('id')
                ->on('departments');
            $table->integer('faculty_qualification_id')->unsigned()->nullable();
            $table->foreign('faculty_qualification_id')
                ->references('id')
                ->on('faculty_qualifications');
            $table->integer('discipline_id')->unsigned()->nullable();
            $table->foreign('discipline_id')
                ->references('id')
                ->on('disciplines');
            $table->integer('number_faculty');
            $table->enum('status',['active','inactive'])->default('active');
            $table->enum('isComplete',['yes','no'])->default('no');
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
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faculty_summaries');
    }
}
