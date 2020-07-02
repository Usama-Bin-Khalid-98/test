<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScopesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scopes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id')->unsigned()->nullable();
            $table->foreign('school_id')
                ->references('id')
                ->on('business_schools')
                ->onDelete('cascade');;
            $table->integer('program_id')->unsigned()->nullable();
            $table->foreign('program_id')
                ->references('id')
                ->on('programs')
                ->onDelete('cascade');;
            $table->integer('level_id')->unsigned()->nullable();
            $table->foreign('level_id')
                ->references('id')
                ->on('levels')
                ->onDelete('cascade');;
            $table->date('date_program');
            $table->enum('status', ['active','inactive'])->default('active');
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
        Schema::dropIfExists('scopes');
    }
}
