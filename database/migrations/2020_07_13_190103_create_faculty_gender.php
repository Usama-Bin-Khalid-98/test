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
        Schema::create('faculty_gender', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('business_school_id')->unsigned();
            $table->foreign('business_school_id')
                ->references('id')
                ->on('business_schools');

            $table->integer('lookup_faculty_type_id')->unsigned();
            $table->foreign('lookup_faculty_type_id')
                ->references('id')
                ->on('lookup_faculty_type');

            $table->integer('year');
            $table->integer('male');
            $table->integer('female');
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
        Schema::dropIfExists('faculty_gender');
    }
}
