<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPoNameToProgramObjectivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('program_objectives', function (Blueprint $table) {
            //
            $table->string('po_name', 100)->after('department_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('program_objectives', function (Blueprint $table) {
            //
            $table->dropColumn('po_name')->after('department_id');
        });
    }
}
