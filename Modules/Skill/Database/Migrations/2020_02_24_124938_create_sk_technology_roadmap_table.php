<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkTechnologyRoadmapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sk_technology_roadmap', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('technology_id')->nullable();
            $table->foreign('technology_id')->references('id')->on('sk_technologies')->onDelete('cascade');
            $table->unsignedBigInteger('roadmap_id')->nullable();
            $table->foreign('roadmap_id')->references('id')->on('sk_roadmaps')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sk_technology_roadmap');
    }
}
