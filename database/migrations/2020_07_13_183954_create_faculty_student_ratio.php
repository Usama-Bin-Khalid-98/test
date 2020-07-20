<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultyStudentRatio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_student_ratio', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('business_school_id')->unsigned();
            $table->foreign('business_school_id')
                ->references('id')
                ->on('business_schools');

            $table->integer('program_id')->unsigned();
            $table->foreign('program_id')
                ->references('id')
                ->on('programs');
            $table->string('year',100);
            $table->integer('total_enrollments');
            $table->enum('status',['active','inactive'])->default('active');
            $table->enum('isComplete',['yes','no'])->default('no');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faculty_student_ratio');
    }
}
