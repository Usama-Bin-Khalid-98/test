<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EligibilityStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('eligibility_statuses', function (Blueprint $table) {
           $table->increments('id');
           $table->integer('campus_id');
           $table->integer('department_id');
           $table->enum('isEligible', ['yes', 'no'])->default('no');
           $table->enum('status', ['active', 'inactive'])->default('active');
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
        //
    }
}
