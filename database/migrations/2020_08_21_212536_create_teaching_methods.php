<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachingMethods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teaching_methods', function (Blueprint $table) {
            $table->increments('id');   
            $table->string('name',100);
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
        Schema::dropIfExists('teaching_methods');
    }
}
