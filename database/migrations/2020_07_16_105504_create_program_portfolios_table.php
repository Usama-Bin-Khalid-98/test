<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramPortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_portfolios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('program_id')->unsigned();
            $table->foreign('program_id')
                ->references('id')
                ->on('programs');
            $table->string('total_semesters',100);
            $table->unsignedBigInteger('course_type_id');
            $table->string('no_of_course',100);   
            $table->string('credit_hours',100);  
            $table->string('internship_req',100);  
            $table->string('fyp_req',100); 
            $table->enum('status', ['active','inactive'])->default('active'); 
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('course_type_id')
                ->references('id')
                ->on('course_types')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('program_portfolios');
    }
}