<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slips', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('business_school_id')->unsigned()->nullable();
            $table->foreign('business_school_id')
                ->references('id')
                ->on('business_schools');
            $table->integer('program_id')->unsigned()->nullable();
            $table->foreign('program_id')
                ->references('id')
                ->on('programs');
            $table->string('slip')->nullable();
            $table->date('transaction_date')->nullable();
            $table->enum('status', ['active', 'inactive','pending', 'paid','approved'])->nullable();
            $table->string('comments', 255)->nullable();
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
        Schema::dropIfExists('slips');
    }
}
