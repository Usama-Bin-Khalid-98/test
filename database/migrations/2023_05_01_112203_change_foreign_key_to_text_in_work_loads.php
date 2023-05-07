<?php

use App\Models\Common\Designation;
use App\Models\Faculty\WorkLoad;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeForeignKeyToTextInWorkLoads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('work_loads', function (Blueprint $table) {
            //
            $table->string('designation',100)->nullable();
            
        });
        foreach(WorkLoad::all() as $workload){
            $designation_name = Designation::find($workload->designation_id)->name;
            $workload->update(['designation'=>$designation_name]);
        }
        Schema::table('work_loads', function (Blueprint $table) {
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
        Schema::table('work_loads', function (Blueprint $table) {
            //
        });
    }
}
