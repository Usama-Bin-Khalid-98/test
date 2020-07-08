<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatutoryCommitteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statutory_committees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('statutory_body_id')->unsigned();
            $table->foreign('statutory_body_id')
                ->references('id')
                ->on('statutory_bodies');
            $table->string('name', 100);
            $table->integer('designation_id')->unsigned();
            $table->date('date_first_meeting');
            $table->date('date_second_meeting');
            $table->date('date_third_meeting');
            $table->date('date_fourth_meeting');
            $table->string('file', 255)->nullable();
            $table->enum('status', ['active','inactive'])->default('active');
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
        Schema::dropIfExists('statutory_committees');
    }
}
