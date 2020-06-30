<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSprCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spr_currencies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('country_id')->nullable(true)->comment('Основные сведения о валюте.ID страны');
            $table->foreign('country_id')->references('id')->on('spr_countries')->onDelete('cascade');
            $table->string('name')->comment('Основные сведения о валюте.Название валюты');
            $table->string('emission_center')->comment('Основные сведения о валюте.Эмиссионный центр');
            $table->string('symbol')->nullable()->comment('Основные сведения о валюте.Знак');
            $table->string('sample_url')->nullable()->comment('Основные сведения о валюте.Образец');
            $table->string('iso_name')->nullable()->comment('ISO 4217.Название');
            $table->string('iso_code')->nullable()->comment('ISO 4217.Код');
            $table->string('iso_code_name')->nullable()->comment('ISO 4217.Название кода(аббревиатура)');
            $table->string('currency_unit')->nullable()->comment('Разменная денежная единица.Название');
            $table->string('currency_unit_sample_url')->nullable()->comment('Разменная денежная единица.Образец');
            $table->string('descr')->nullable()->comment('Примечание');
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
        Schema::dropIfExists('spr_currencies');
    }
}
