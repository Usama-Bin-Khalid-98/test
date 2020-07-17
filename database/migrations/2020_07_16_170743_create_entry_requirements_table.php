<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntryRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entry_requirements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('program_id')->unsigned();
            $table->foreign('program_id')
                ->references('id')
                ->on('programs');
            $table->unsignedBigInteger('eligibility_criteria_id');
            $table->string('min_req',100);    
            $table->enum('status', ['active','inactive'])->default('active'); 
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('eligibility_criteria_id')
                ->references('id')
                ->on('eligibility_criterias')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entry_requirements');
    }
}