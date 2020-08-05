<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slips', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_no', 50);
            $table->integer('business_school_id')->unsigned()->nullable();
            $table->foreign('business_school_id')
                ->references('id')
                ->on('business_schools');
            $table->integer('department_id')->unsigned()->nullable();
            $table->foreign('department_id')
                ->references('id')
                ->on('departments');
            $table->string('slip')->nullable();
            $table->string('payment_method_id')->unsigned()->nullable();
            $table->foreign('payment_method')
                ->references('id')
                ->on('payment_methods');
            $table->string('cheque_no')->nullable();
            $table->date('transaction_date')->nullable();
            $table->enum('status', ['active', 'inactive','pending', 'paid','approved'])->nullable();
            $table->string('comments', 255)->nullable();
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
        Schema::dropIfExists('slips');
    }
}
