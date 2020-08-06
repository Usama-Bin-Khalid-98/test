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
            $table->integer('campus_id')->unsigned();
            $table->foreign('campus_id')
                ->references('id')
                ->on('campuses');
            $table->integer('lookup_faculty_qualification_id')->unsigned();
            $table->foreign('lookup_faculty_qualification_id')
                ->references('id')
            ->on('lookup_faculty_qualification');
            $table->integer('discipline_id')->unsigned();
            $table->foreign('discipline_id')
                ->references('id')
                ->on('disciplines');
            $table->integer('faculty_available');
            $table->enum('status',['active','inactive'])->default('active');
            $table->enum('isComplete',['yes','no'])->default('no');
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


