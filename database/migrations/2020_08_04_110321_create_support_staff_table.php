<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_staff', function (Blueprint $table) {
            $table->id();
            $table->integer('campus_id')->unsigned();
            $table->foreign('campus_id')
                ->references('id')
                ->on('campuses');
            $table->BigInteger('staff_category_id')->unsigned();
            $table->foreign('staff_category_id')
                ->references('id')
                ->on('staff_categories');
            $table->string('total_staff',255);
            $table->string('supervisor_qualification',255);
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
        Schema::dropIfExists('support_staff');
    }
}