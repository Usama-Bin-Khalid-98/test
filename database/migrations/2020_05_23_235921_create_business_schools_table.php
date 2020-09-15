<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_schools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('contact_person', 80)->nullable();
            $table->string('year_estb',100)->nullable();
            $table->string('campus_year_estb',100)->nullable();
            $table->string('address', 255)->nullable();
            $table->integer('cao_id' )->nullable();
            $table->string('web_url',255)->nullable();
            $table->string('date_charter_granted',100)->nullable();
            $table->string('charter_number', 255)->nullable();
            $table->integer('charter_type_id')->nullable();
            $table->integer('institute_type_id')->nullable();
            $table->enum('sector', ['public', 'private'])->nullable();
            $table->enum('profit_status',['For Profit', 'None Profit'])->nullable();
            $table->enum('status',['active','inactive']);
            $table->enum('isCompleted',['yes','no'])->default('no');
            $table->enum('hierarchical_context',['Affiliated', 'Constituent Part'] )->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_schools');
    }
}
