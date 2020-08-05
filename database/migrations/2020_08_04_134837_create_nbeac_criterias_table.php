<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNbeacCriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nbeac_criterias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('campus_id')->unsigned()->nullable();
            $table->foreign('campus_id')
                ->references('id')
                ->on('campuses');
            $table->string('editor1', 255)->nullable();
            $table->string('editor2', 255)->nullable();
            $table->string('editor3', 255)->nullable();
            $table->string('editor4', 255)->nullable();
            $table->string('editor5', 255)->nullable();
            $table->string('editor6', 255)->nullable();
            $table->string('editor7', 255)->nullable();
            $table->string('editor8', 255)->nullable();
            $table->string('editor9', 255)->nullable();
            $table->enum('status',['active','inactive'])->default('active');
            $table->enum('isCompleted',['yes','no'])->default('no');
            $table->integer('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')
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
        Schema::dropIfExists('nbeac_criterias');
    }
}
