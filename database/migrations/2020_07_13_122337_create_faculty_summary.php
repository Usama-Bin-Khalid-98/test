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

            $table->integer('business_school_id')->unsigned();
            $table->foreign('business_school_id')
                ->references('id')
                ->on('business_schools');

            $table->integer('lookup_faculty_program_id')->unsigned();
            $table->foreign('lookup_faculty_program_id')->references('id')->on('lookup_faculty_program');
           
            $table->integer('program_id')->unsigned();
            $table->foreign('program_id')->references('id')
            ->on('programs');
       
            $table->integer('faculty_available');
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
        Schema::dropIfExists('faculty_summary');
    }
}


