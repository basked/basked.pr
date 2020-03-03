<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sk_topics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('technology_id')->comment('Ссылка на технологию');
            $table->foreign('technology_id')->references('id')->on('sk_technologies');
            $table->string('name')->comment('Наименование темы');
            $table->string('slug')->comment('Slug');
            $table->string('descr')->nullable()->comment('Описание');
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
        Schema::dropIfExists('sk_topics');
    }
}
