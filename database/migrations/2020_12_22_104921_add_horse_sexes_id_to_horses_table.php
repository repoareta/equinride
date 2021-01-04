<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHorseSexesIdToHorsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('horses', function (Blueprint $table) {
            $table->unsignedBigInteger('horse_sexes_id');

            $table->foreign('horse_sexes_id')->references('id')->on('horse_sexes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('horses', function (Blueprint $table) {
            $table->dropColumn('horse_sexes_id');
        });
    }
}
