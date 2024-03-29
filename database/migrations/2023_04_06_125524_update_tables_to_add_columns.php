<?php

use App\Models\Common\Designation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateTablesToAddColumns extends Migration


{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('mission_visions', function (Blueprint $table) {
            $table->string('mission_url', 255);
        });

        Schema::table('nbeac_criterias', function (Blueprint $table) {
            $table->text('faculty_portfolio')->nullable();
        });

        DB::statement("ALTER TABLE slips MODIFY COLUMN status ENUM('active', 'inactive', 'pending', 'paid', 'approved', 'unpaid') NOT NULL;");
        DB::statement("ALTER TABLE mentoring_invoices MODIFY COLUMN status ENUM('active', 'inactive', 'pending', 'paid', 'approved', 'unpaid') NOT NULL;");
        
        Schema::table('designations', function (Blueprint $table) {
            $table->boolean('is_default')->default(false);
        });
        
        DB::table('designations')->update(['is_default' => true]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('mission_visions', function (Blueprint $table) {
            $table->dropColumn('mission_url');
        });

        Schema::table('nbeac_criterias', function (Blueprint $table) {
            $table->dropColumn('faculty_portfolio');
        });

        DB::statement("ALTER TABLE slips MODIFY COLUMN status ENUM('active', 'inactive', 'pending', 'paid', 'approved') NOT NULL;");
        DB::statement("ALTER TABLE mentoring_invoices MODIFY COLUMN status ENUM('active', 'inactive', 'pending', 'paid', 'approved') NOT NULL;");
    
        Schema::table('designations', function (Blueprint $table) {
            $table->dropColumn('is_default');
        });
    }
}
