<?php

use App\Models\Common\Designation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\StrategicManagement\Affiliation;

class AddDesignationsRelationToAffiliations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('affiliations', function (Blueprint $table) {
            $table->integer('designation_id')->unsigned()->nullable();
            $table->foreign('designation_id')
                ->references('id')
                ->on('designations');
        });
        
        foreach(Affiliation::all() as $affiliation){
            $designation = Designation::where('name', $affiliation->designation)->first();
            if(!$designation){
                $designation = Designation::create([
                    'name' => $affiliation->designation
                ]);    
            }
            $affiliation->update([
                'designation_id' => $designation->id
            ]);
        }

        Schema::table('affiliations', function (Blueprint $table) {
            $table->dropColumn('designation');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('affiliations', function (Blueprint $table) {
            $table->string('designation', 100)->nullable();
        });

        foreach(Designation::all() as $designation){
            Affiliation::where('designation_id', $designation->id)
                ->update([
                    'designation' => $designation->name
                ]);
        }

        Schema::table('affiliations', function (Blueprint $table) {
            $table->dropForeign(['designation_id']);
            $table->dropColumn('designation_id');
        });
    }
}
