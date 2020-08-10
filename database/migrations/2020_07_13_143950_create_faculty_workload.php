<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultyWorkload extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_load', function (Blueprint $table) {
            $table->increments('id');

             $table->integer('business_school_id')->unsigned();
             $table->foreign('business_school_id')
             ->references('id')
             ->on('business_schools');

            $table->string('faculty_name',50)->nullable();

          //  $table->integer('faculty_designation_id')->unsigned();
             // $table->foreign('faculty_designation_id')
             // ->references('id')
             // ->on('lookup_faculty_desination');

             $table->integer('designation_id')->unsigned();
            $table->foreign('designation_id')
                ->references('id')
                ->on('designations');


             $table->integer('total_courses')->nullable();
             $table->integer('phd')->nullable();
             $table->integer('masters')->nullable();
             $table->integer('bachleors')->nullable();
             $table->string('admin_responsibilities',100)->nullable();
             $table->string('year',100)->nullable();
             //$table->varchar('policy',50)->nullable();
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
        Schema::dropIfExists('work_load');
    }
}
