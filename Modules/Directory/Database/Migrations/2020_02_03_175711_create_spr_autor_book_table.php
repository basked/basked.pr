<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSprAutorBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spr_autor_book', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('autor_id');
            $table->unsignedBigInteger('book_id');
            $table->timestamps();
            $table->foreign('autor_id')->references('id')->on('spr_autors');
            $table->foreign('book_id')->references('id')->on('spr_books');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spr_autors_books');
    }
}
