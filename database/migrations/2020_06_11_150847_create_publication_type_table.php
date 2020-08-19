<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicationTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publication_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->bigInteger('publication_category_id')->unsigned();
            $table->foreign('publication_category_id')
                ->references('id')
                ->on('publication_categories');
            $table->enum('status', ['active','inactive'])->default('active');
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
        Schema::dropIfExists('publication_types');
    }
}
