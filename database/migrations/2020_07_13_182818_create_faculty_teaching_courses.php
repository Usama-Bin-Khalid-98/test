<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultyTeachingCourses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_teaching_courses', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('business_school_id')->unsigned();
            $table->foreign('business_school_id')
                ->references('id')
                ->on('business_schools');


            $table->integer('lookup_faculty_type_id')->unsigned();
            $table->foreign('lookup_faculty_type_id')
                ->references('id')
                ->on('lookup_faculty_type');

            $table->integer('lookup_faculty_designation_id')->unsigned();
            $table->foreign('lookup_faculty_designation_id')
                ->references('id')
                ->on('lookup_faculty_desination');

 $table->integer('max_courses _allowed');
  $table->integer('tc_program1');
  $table->integer('tc_program2');
    
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
        Schema::dropIfExists('faculty_teaching_courses');
    }
}
