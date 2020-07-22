<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financial_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('business_school_id')->unsigned();
            $table->foreign('business_school_id')
                ->references('id')
                ->on('business_schools');
            $table->integer('income_source_id')->unsigned();
            $table->foreign('income_source_id')
                ->references('id')
                ->on('income_sources');
            $table->year('t-3');
            $table->year('t-2');
            $table->year('t-1');
            $table->year('t');
            $table->year('t+1');
            $table->year('t+2');
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
        Schema::dropIfExists('financial_infos');
    }
}
