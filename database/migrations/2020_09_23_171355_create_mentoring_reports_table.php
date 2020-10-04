<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentoringReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentoring_reports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('mentoring_invoice_id')->unsigned();
            $table->foreign('mentoring_invoice_id')
                ->references('id')
                ->on('mentoring_invoices');
            $table->text('comments');
            $table->enum('status', ['Mentor', 'Approved', 'nbeac'])->nullable();
            $table->date('report_date');
            $table->date('registration_date');
            $table->date('sar_date');
            $table->string('file', 255)->nullable();
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
        Schema::dropIfExists('mentoring_reports');
    }
}
