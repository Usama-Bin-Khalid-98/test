<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->string('contact_person', 80);
            $table->date('year_estb');
            $table->string('address', 255);
            $table->integer('cao_id' )->nullable();
            $table->string('web_url',255);
            $table->date('date_charter_granted' );
            $table->string('charter_number', 255);
            $table->integer('charter_type_id');
            $table->integer('institute_type_id');
            $table->enum('sector', ['public', 'private']);
            $table->enum('profit_status',['For Profit', 'None Profit']);
            $table->enum('hierarchical_context',['Affiliated', 'Constituent Part'] );
            $table->string('email',100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',255);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
