<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToPeerReviewReviewerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('peer_review_reviewers', function (Blueprint $table) {
            $table->enum('status', ['yes', 'no'])->default('no')->after('user_id');
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
        Schema::table('peer_review_reviewers', function (Blueprint $table) {
            $table->dropColumn('status', ['yes', 'no'])->default('no')->after('user_id');
            //
        });
    }
}
