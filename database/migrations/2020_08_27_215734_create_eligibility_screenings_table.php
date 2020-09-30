<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEligibilityScreeningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eligibility_screenings', function (Blueprint $table) {
            $table->id();
            $table->integer('campus_id')->unsigned()->nullable();
            $table->foreign('campus_id')
                ->references('id')
                ->on('campuses');
            $table->integer('department_id')->unsigned()->nullable();
            $table->foreign('department_id')
                ->references('id')
                ->on('departments');
            $table->integer('slip_id')->unsigned()->nullable();
            $table->foreign('slip_id')
                ->references('id')
                ->on('slips');
            $table->string('title', 255);
            $table->dateTime('start');
            $table->dateTime('end');
            $table->string('allDay', 100)->nullable();
            $table->string('url', 255)->nullable();
            $table->string('backgroundColor', 20)->nullable();
            $table->string('borderColor', 20)->nullable();
            $table->enum('status', ['active','inactive'])->default('active');
            $table->enum('isComplete',['yes','no'])->default('no');
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
        Schema::dropIfExists('eligibility_screenings');
    }
}
