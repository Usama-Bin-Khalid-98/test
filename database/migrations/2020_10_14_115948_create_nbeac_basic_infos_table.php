<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNbeacBasicInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nbeac_basic_infos', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('short_name', 20);
            $table->string('email', 100);
            $table->string('phone1', 20);
            $table->string('phone2', 20);
            $table->string('fax', 30);
            $table->string('address', 255);
            $table->string('website', 255);
            $table->string('director', 100);
            $table->string('chairman', 100);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
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
        Schema::dropIfExists('nbeac_basic_infos');
    }
}
