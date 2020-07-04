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

            $table->integer('business_school_id');
            $table->integer('discipline_id')->unsigned();
            $table->integer('department')->unsigned();
            $table->integer('role_id');
            $table->integer('designation_id')->unsigned();
            $table->integer('region_id')->unsigned();
            $table->integer('sector_id')->unsigned();
            $table->string('qualification', 255);
            $table->string('degree_title', 255);
            $table->string('specialization', 255);
            $table->date('year_completion');
            $table->string('from_institute', 255);
            $table->string('employed_at', 255);
            $table->string('length_service', 255);
            $table->string('industry_exp', 255);
            $table->string('academic_exp', 255);
            $table->string('research_publication', 255);
            $table->string('nbeac_seminar', 255)->nullable();
            $table->date('date_seminar')->nullable();
            $table->string('recommend', 255);
            $table->string('user_id', 255);
            $table->string('address', 255);

            $table->string('email',100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',255);
            $table->string('user_type', 50);
            $table->enum('status', ['active', 'inactive', 'pending', 'approved']);
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
