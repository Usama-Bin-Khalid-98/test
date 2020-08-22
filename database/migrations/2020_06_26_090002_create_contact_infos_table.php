<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('email', 100);
            $table->string('contact_no', 25);
            $table->string('school_contact', 25);
            $table->integer('designation_id')->unsigned();
            $table->foreign('designation_id')
                ->references('id')
                ->on('designations');
            $table->string('cv', 255);
            $table->enum('status', ['active','inactive'])->default('active');
            $table->enum('isComplete',['yes','no'])->default('no');
            $table->integer('campus_id')->unsigned()->nullable();
            $table->foreign('campus_id')
                ->references('id')
                ->on('campuses');
            $table->integer('department_id')->unsigned()->nullable();
            $table->foreign('department_id')
                ->references('id')
                ->on('departments');
            $table->string('job_title', 100)->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->foreign('created_by')
                ->references('id')
                ->on('users');
            $table->integer('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')
                ->references('id')
                ->on('users');
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->foreign('deleted_by')
                ->references('id')
                ->on('users');
            $table->softDeletes();
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
        Schema::dropIfExists('contact_infos');
    }
}
