<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationReceivedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_received', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('program_id')->unsigned();
            $table->foreign('program_id')
                ->references('id')
                ->on('programs');
            $table->unsignedBigInteger('semester_id');
            $table->string('app_received',100);    
            $table->string('admission_offered',100);    
            $table->string('student_intake',100);    
            $table->string('semester_comm_date',100);    
            $table->enum('status', ['active','inactive'])->default('active'); 
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('semester_id')
                ->references('id')
                ->on('semesters')
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
        Schema::dropIfExists('application_received');
    }
}
