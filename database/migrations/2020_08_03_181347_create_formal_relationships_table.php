<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormalRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formal_relationships', function (Blueprint $table) {
            $table->id();
            $table->integer('campus_id')->unsigned();
            $table->foreign('campus_id')
                ->references('id')
                ->on('campuses');
            $table->string('org_name',255);
            $table->string('mou_title',255);
            $table->string('signing_mou_date', 255);
            $table->string('last_activity_date', 255);
            $table->string('last_activity_desc', 255);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('isComplete', ['yes', 'no'])->default('no');
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
        Schema::dropIfExists('formal_relationships');
    }
}
