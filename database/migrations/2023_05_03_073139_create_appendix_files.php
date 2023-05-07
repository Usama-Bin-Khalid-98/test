<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppendixFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appendix_files', function (Blueprint $table) {
            //
            $table->id();
            $table->integer('campus_id')->unsigned()->nullable();
            $table->foreign('campus_id')
                ->references('id')
                ->on('campuses');
            $table->integer('business_school_id')->unsigned()->nullable();
            $table->foreign('business_school_id')
                ->references('id')
                ->on('business_schools');
            $table->string('workload_policy', 255)->nullable();
            $table->string('research_summary', 255)->nullable();
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
        Schema::table('appendix_files', function (Blueprint $table) {
            //
        });
    }
}
