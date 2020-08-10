<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatutoryBodiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statutory_bodies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->softDeletes();
            $table->enum('isCompleted',['yes','no'])->default('no');
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
        Schema::dropIfExists('statutory_bodies');
    }
}
