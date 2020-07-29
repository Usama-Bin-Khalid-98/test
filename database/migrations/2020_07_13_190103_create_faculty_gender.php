<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultyGender extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_genders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('campus_id')->unsigned()->nullable();
            $table->foreign('campus_id')
                ->references('id')
                ->on('campuses');
            $table->integer('lookup_faculty_type_id')->unsigned()->nullable();
            $table->foreign('lookup_faculty_type_id')
                ->references('id')
                ->on('lookup_faculty_types');
            $table->integer('year');
            $table->integer('male');
            $table->integer('female');
            $table->enum('status',['active','inactive'])->default('active');
            $table->enum('isCompleted',['yes','no'])->default('no');
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
        Schema::dropIfExists('faculty_genders');
    }
}
