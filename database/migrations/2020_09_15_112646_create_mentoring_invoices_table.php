<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentoringInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentoring_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no', 50);
            $table->integer('campus_id')->unsigned()->nullable();
            $table->foreign('campus_id')
                ->references('id')
                ->on('campuses');
            $table->integer('department_id')->unsigned()->nullable();
            $table->foreign('department_id')
                ->references('id')
                ->on('departments');
            $table->string('slip')->nullable();
            $table->integer('fee_type_id')->unsigned();
            $table->foreign('fee_type_id')
                ->references('id')
                ->on('fee_types');
            $table->double('amount');
            $table->integer('payment_method_id')->unsigned()->nullable();
            $table->foreign('payment_method_id')
                ->references('id')
                ->on('payment_methods');
            $table->string('cheque_no')->nullable();
            $table->string('transaction_date',100)->nullable();
            $table->enum('status', ['active', 'inactive','pending', 'paid','approved'])->nullable();
            $table->enum('isEligible', ['yes', 'no'])->nullable();
            $table->enum('isEligibleNBEAC', ['yes', 'no'])->nullable()->default('no');
            $table->enum('isEligibleMentor', ['yes', 'no'])->nullable()->default('no');
            $table->enum('regStatus', ['Initiated','Pending','Review','Eligibility','ScheduledES','ScheduledPR','Mentoring','ScheduledMentoring','SAR','Active', 'Inactive', 'Approved'])->nullable()->default('Initiated');
            $table->string('comments', 255)->nullable();
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
        Schema::dropIfExists('mentoring_invoices');
    }
}
