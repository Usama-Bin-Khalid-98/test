<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffiliationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->integer('campus_id')->unsigned()->nullable();
            $table->foreign('campus_id')
                ->references('id')
                ->on('campuses');
            $table->string('affiliation', 255);
            $table->integer('designation_id')->unsigned();
            $table->foreign('designation_id')
                ->references('id')
                ->on('designations');
            $table->integer('statutory_bodies_id')->unsigned()->nullable();
            $table->foreign('statutory_bodies_id')
                ->references('id')
                ->on('statutory_bodies');
            $table->enum('status', ['active','inactive'])->default('active');
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
        Schema::dropIfExists('affiliations');
    }
}
