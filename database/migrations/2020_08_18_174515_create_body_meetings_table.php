<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBodyMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('body_meetings', function (Blueprint $table) {
            $table->id();
            $table->integer('campus_id')->unsigned();
            $table->foreign('campus_id')
                ->references('id')
                ->on('campuses');
            $table->integer('department_id')->unsigned()->nullable();
            $table->foreign('department_id')
                ->references('id')
                ->on('departments');
            $table->string('participant_name',255);
            $table->integer('designation_id')->unsigned()->nullable();
            $table->foreign('designation_id')
                ->references('id')
                ->on('designations');
            $table->string('affiliation',255);
            $table->integer('statutory_bodies_id')->unsigned()->nullable();
            $table->foreign('statutory_bodies_id')
                ->references('id')
                ->on('statutory_bodies');
            $table->text('meeting_date');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('isComplete', ['yes', 'no'])->default('no');
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
        Schema::dropIfExists('body_meetings');
    }
}
