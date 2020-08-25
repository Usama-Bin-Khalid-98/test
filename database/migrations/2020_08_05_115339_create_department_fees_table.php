<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_fees', function (Blueprint $table) {
            $table->id();
//            $table->integer('campus_id')->unsigned();
//            $table->foreign('campus_id')
//                ->references('id')
//                ->on('campuses');
            $table->integer('department_id')->unsigned();
            $table->foreign('department_id')
                ->references('id')
                ->on('departments');
            $table->BigInteger('fee_type_id')->unsigned();
            $table->foreign('fee_type_id')
                ->references('id')
                ->on('fee_types');
            $table->integer('amount');
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
        Schema::dropIfExists('department_fees');
    }
}
