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
            $table->integer('designation_id')->unsigned();
            // personal info
            $table->string('cnic', 80);
            $table->string('contact_no', 25);
            $table->string('country');
            $table->string('city');
            $table->string('address', 255)->nullable();

            //business school
            $table->integer('business_school_id')->unsigned();
            $table->foreign('business_school_id')
                ->references('id')
                ->on('business_schools');
            $table->integer('discipline_id')->unsigned()->nullable();
            $table->integer('department_id')->unsigned()->nullable();

            //peer review
            $table->integer('reviewer_role_id')->nullable();
            $table->integer('region_id')->unsigned()->nullable();
            $table->integer('sector_id')->unsigned()->nullable();
            $table->string('qualification', 255)->nullable();
            $table->integer('degree_id')->nullable();
            $table->string('specialization', 255)->nullable();
            $table->date('year_completion')->nullable();
            $table->string('from_institute', 255)->nullable();
            $table->string('employed_at', 255)->nullable();
            $table->string('length_service', 255)->nullable();
            $table->string('industry_exp', 255)->nullable();
            $table->string('academic_exp', 255)->nullable();
            $table->string('research_publication', 255)->nullable();
            $table->string('nbeac_seminar', 255)->nullable();
            $table->date('date_seminar')->nullable();
            $table->string('recommend', 255)->nullable();
            $table->string('user_id', 255)->nullable();

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
