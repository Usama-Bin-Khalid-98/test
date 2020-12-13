<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToMentoringMentorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mentoring_mentors', function (Blueprint $table) {
            $table->enum('status', ['active', 'inactive'])->default('inactive')->after('user_id');
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mentoring_mentors', function (Blueprint $table) {
            $table->dropColumn('status', ['active', 'inactive'])->default('inactive')->after('user_id');
        });
    }
}
