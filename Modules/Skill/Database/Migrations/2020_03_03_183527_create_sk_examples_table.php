<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkExamplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sk_examples', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('topic_id')->comment('Тема');
            $table->foreign('topic_id')->references('id')->on('sk_topics');
            $table->string('name')->nullable()->comment("Наименование");
            $table->text('code')->nullable()->comment("Код программы");
            $table->string('slug')->nullable()->comment("slug");
            $table->string('descr')->nullable()->comment("Описание");
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
        Schema::dropIfExists('sk_examples');
    }
}