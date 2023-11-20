<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCurriculumReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('curriculum_reviews', function (Blueprint $table) {
            $table->dropForeign(['designation_id', 'affiliations_id']);
            $table->dropColumn('designation_id');
            $table->dropColumn('affiliations_id');
            $table->dropColumn('composition');
            $table->dropColumn('reviewer_names');
        });

        Schema::table('curriculum_reviews', function (Blueprint $table) {
            $table->text('composition')->after('date');
            $table->text('reviewer_names')->after('composition');
            $table->text('designations_affiliations')->after('reviewer_names');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('curriculum_reviews', function (Blueprint $table) {
            $table->dropColumn('compostion');
            $table->dropColumn('reviewer_names');
            $table->dropColumn('designations_affiliations');
        });

        Schema::table('curriculum_reviews', function (Blueprint $table) {
            $table->string('compostion', 255)->after('date');
            $table->string('reviewer_names', 100)->after('composition');
            $table->integer('designation_id')->unsigned()->nullable();
            $table->foreign('designation_id')
                ->references('id')
                ->on('designations')
                ->onDelete('cascade');
            $table->integer('affiliation_id')->unsigned()->nullable();
            $table->foreign('affiliation_id')
                ->references('id')
                ->on('affiliations')
                ->onDelete('cascade');
        });
        
    }
}
