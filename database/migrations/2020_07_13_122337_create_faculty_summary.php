<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultySummary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_summary', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedBigInteger('business_school_id');
            

            $table->unsignedBigInteger('lookup_faculty_program_id');
            

            $table->integer('program_id')->unsigned();
            

            $table->integer('faculty_available');
            $table->enum('status',['active','inactive'])->default('active');
            
            $table->timestamps();
            $table->enum('isComplete',['yes','no'])->default('no');
            //$table->foreign('business_school_id')->references('id')->on('business_schools');
            //$table->foreign('lookup_faculty_program_id')->references('id')->on('lookup_faculty_program');
            //$table->foreign('program_id')->references('id')->on('programs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faculty_summary');
    }
}


