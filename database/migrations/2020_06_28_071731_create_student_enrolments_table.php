<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentEnrolmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_enrolments', function (Blueprint $table) {
            $table->id();
            $table->integer('business_school_id')->unsigned()->nullable();
            $table->foreign('business_school_id')
                ->references('id')
                ->on('business_schools')
                ->onDelete('cascade');;
            $table->string('year', 100);
            $table->string('bs_level', 100);
            $table->string('ms_level', 100);
            $table->string('phd_level', 100);
            $table->string('total_students', 100);
            $table->integer('program_id')->unsigned()->nullable();
            $table->foreign('program_id')
                ->references('id')
                ->on('programs')
                ->onDelete('cascade');;
            $table->string('grad_std_t', 100);
            $table->string('grad_std_t_2', 100);
            $table->string('grad_std_t_3', 100);
            $table->string('male', 100);
            $table->string('female', 100);
            $table->enum('status', ['active','inactive'])->default('active');
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
        Schema::dropIfExists('student_enrolments');
    }
}
