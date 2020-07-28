<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessSchoolFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_school_facilities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('campus_id')->unsigned()->nullable();
            $table->foreign('campus_id')
                ->references('id')
                ->on('campuses');
            $table->integer('facility_id')->unsigned();
            $table->foreign('facility_id')
                ->references('id')
                ->on('facilities');
            $table->string('remark',250)->nullable();
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
        Schema::dropIfExists('business_school_facilities');
    }
}
