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
                
                $table->string('program',50);
                $table->integer('total_enrollments');


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
        Schema::dropIfExists('faculty_student_ratio');
    }
}
