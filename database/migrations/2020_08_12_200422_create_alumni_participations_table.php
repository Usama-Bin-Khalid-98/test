<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumniParticipationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni_participations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('campus_id')->unsigned()->nullable();
            $table->foreign('campus_id')
                ->references('id')
                ->on('campuses');
            $table->integer('department_id')->unsigned()->nullable();
            $table->foreign('department_id')
                ->references('id')
                ->on('departments');
            $table->BigInteger('activity_engagements_id')->unsigned()->nullable();
            $table->foreign('activity_engagements_id')
                ->references('id')
                ->on('activity_engagements');
            $table->string('alumni_participated',100);
            $table->text('major_input');
            $table->enum('isComplete',['yes','no'])->default('no');
            $table->enum('status',['active','inactive'])->default('active');
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
        Schema::dropIfExists('alumni_participations');
    }
}
