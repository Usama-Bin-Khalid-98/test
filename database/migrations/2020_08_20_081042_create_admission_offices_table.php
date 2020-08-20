<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admission_offices', function (Blueprint $table) {
            $table->id();
            $table->integer('campus_id')->unsigned();
            $table->foreign('campus_id')
                ->references('id')
                ->on('campuses');
            $table->integer('department_id')->unsigned()->nullable();
            $table->foreign('department_id')
                ->references('id')
                ->on('departments');
            $table->string('hierarchical_position',100);
            $table->string('system_handling',100);
            $table->string('head',100);
            $table->string('qualification',100);
            $table->string('total_staff',100);
            $table->string('printers',100);
            $table->string('photocopiers',100);
            $table->string('secure_cabinets',100);
            $table->string('hierarchical_positionb',100);
            $table->string('system_handlingb',100);
            $table->string('headb',100);
            $table->string('qualificationb',100);
            $table->string('total_staffb',100);
            $table->string('printersb',100);
            $table->string('photocopiersb',100);
            $table->string('secure_cabinetsb',100);
            $table->string('file',255);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('isComplete', ['yes', 'no'])->default('no');
            $table->integer('created_by')->unsigned()->nullable();
            $table->foreign('created_by')
                ->references('id')
                ->on('users');
            $table->integer('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')
                ->references('id')
                ->on('users');
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->foreign('deleted_by')
                ->references('id')
                ->on('users');
            $table->softDeletes();
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
        Schema::dropIfExists('admission_offices');
    }
}
