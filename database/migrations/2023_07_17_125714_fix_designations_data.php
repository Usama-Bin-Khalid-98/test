<?php

use App\Models\Common\Designation;
use App\Models\Faculty\WorkLoad;
use App\Models\StrategicManagement\StatutoryCommittee;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class FixDesignationsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach(StatutoryCommittee::all() as $committe){
            if(ctype_digit($committe->designation_id) || is_null($committe->designation_id)){
                continue;
            }
            $designation = Designation::where('name', $committe->designation_id)->first();
            if(!$designation){
                $designation = Designation::create([
                    'name' => $committe->designation_id
                ]);
            }
            $committe->update([
                'designation_id' => $designation->id
            ]);
        }

        foreach(WorkLoad::all() as $workload){
            if(ctype_digit($workload->designation_id) || is_null($workload->designation_id)){
                continue;
            }
            $designation = Designation::where('name', $workload->designation_id)->first();
            if(!$designation){
                $designation = Designation::create([
                    'name' => $workload->designation_id
                ]);
            }
            $workload->update([
                'designation_id' => $designation->id
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
