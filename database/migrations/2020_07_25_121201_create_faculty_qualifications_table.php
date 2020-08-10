<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultyQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_qualifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
<<<<<<< HEAD
=======
            $table->softDeletes();
>>>>>>> fb5ba0be3d2c2c24a2617060c6f106a0c26b7269
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faculty_qualifications');
    }
}
