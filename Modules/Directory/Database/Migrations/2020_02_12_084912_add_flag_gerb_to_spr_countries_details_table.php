<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFlagGerbToSprCountriesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('spr_countries_details', function (Blueprint $table) {
          $table->string('img_flag')->nullable();
          $table->string('img_gerb')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('spr_countries_details', function (Blueprint $table) {
            $table->dropColumn('img_flag');
            $table->dropColumn('img_gerb');
        });
    }
}
