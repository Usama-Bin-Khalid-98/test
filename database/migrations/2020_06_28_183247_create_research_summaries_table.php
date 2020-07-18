<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResearchSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research_summaries', function (Blueprint $table) {
            $table->id();
            $table->integer('publication_type_id')->unsigned();
            $table->foreign('publication_type_id')
                ->references('id')
                ->on('publication_types');
            $table->integer('business_school_id')->unsigned();
            $table->foreign('business_school_id')
                ->references('id')
                ->on('business_schools');
            $table->string('year', 10);
            $table->string('total_items', 10);
            $table->string('contributing_core_faculty', 10);
            $table->string('jointly_produced_other', 10);
            $table->string('jointly_produced_same', 10);
            $table->string('jointly_produced_multiple', 10);
            $table->enum('status', ['active','inactive'])->default('active');
            $table->enum('isComplete',['yes','no'])->default('no');
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
        Schema::dropIfExists('research_summaries');
    }
}
