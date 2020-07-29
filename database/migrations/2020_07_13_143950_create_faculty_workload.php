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
        Schema::create('work_loads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('campus_id')->unsigned()->nullable();
            $table->foreign('campus_id')
                ->references('id')
                ->on('campuses');
            $table->string('faculty_name',50)->nullable();
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
        Schema::dropIfExists('work_loads');
    }
}
