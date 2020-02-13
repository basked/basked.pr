<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkTechnologyTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sk_technology_type', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('technology_id');
            $table->foreign('technology_id')->references('id')->on('sk_technologies');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('sk_types');
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
        Schema::dropIfExists('sk_technology_type');
    }
}
