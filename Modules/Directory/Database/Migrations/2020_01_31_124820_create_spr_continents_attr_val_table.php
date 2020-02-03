<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSprContinentsAttrValTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spr_continents_attr_val', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('continent_id');
            $table->unsignedBigInteger('continent_attr_id');
            $table->string('val')->nullable();
            $table->timestamps();
            $table->foreign('continent_id')->references('id')->on('spr_continents');
            $table->foreign('continent_attr_id')->references('id')->on('spr_continents_attr');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spr_continents_attr_val');
    }
}
