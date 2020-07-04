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
            $table->string('contact_no', 25)->nullable();
            $table->date('year_estb')->nullable();

            $table->integer('country_id')->unsigned()->nullable();
            $table->integer('city_id')->unsigned()->nullable();
            $table->integer('slip_id')->unsigned()->nullable();

            $table->string('address', 255)->nullable();
            $table->integer('cao_id' )->nullable();
            $table->string('web_url',255)->nullable();
            $table->date('date_charter_granted')->nullable();
            $table->string('charter_number', 255)->nullable();
            $table->integer('charter_type_id')->nullable();
            $table->integer('institute_type_id')->nullable();
            $table->enum('sector', ['public', 'private'])->nullable();
            $table->enum('profit_status',['For Profit', 'None Profit'])->nullable();
            $table->enum('status',['active','inactive']);
            $table->enum('hierarchical_context',['Affiliated', 'Constituent Part'] )->nullable();
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
        Schema::dropIfExists('business_schools');
    }
}
