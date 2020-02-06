<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditGroupSprUnitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('spr_units', function (Blueprint $table) {
            $table->renameColumn('group', 'unit_group')->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('spr_units', function (Blueprint $table) {
            $table->renameColumn('unit_group','group')->change();

        });
    }
}
