<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionVisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mission_visions', function (Blueprint $table) {
            $table->id();
            $table->integer('campus_id')->unsigned();
            $table->foreign('campus_id')
                ->references('id')
                ->on('campuses');
            $table->text('mission');
            $table->text('vision');
            $table->string('file', 255);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('isComplete', ['yes', 'no'])->default('no');
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
        Schema::dropIfExists('mission_visions');
    }
}
