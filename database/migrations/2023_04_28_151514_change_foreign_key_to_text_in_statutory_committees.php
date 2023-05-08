<?php

use App\Models\Common\Designation;
use App\Models\StrategicManagement\StatutoryCommittee;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChangeForeignKeyToTextInStatutoryCommittees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('statutory_committees', function (Blueprint $table) {
            //
            $table->string('designation', 100)->nullable();
            
        });
        foreach(StatutoryCommittee::all() as $committee){
            $designation_name = Designation::find($committee->designation_id)->name;
            $committee->update(['designation' => $designation_name]);
        }
        Schema::table('statutory_committees', function (Blueprint $table) {
            //
            $table->dropForeign(['designation_id']);
            $table->dropColumn('designation_id');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('statutory_committees', function (Blueprint $table) {
            //
        });
    }
}
