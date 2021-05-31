<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHorseIdAndCoachIdToSlotUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('slot_user', function (Blueprint $table) {
            $table->unsignedBigInteger('horse_id')->nullable();
            $table->unsignedBigInteger('coach_id')->nullable();

            $table->foreign('horse_id')->references('id')->on('horses');
            $table->foreign('coach_id')->references('id')->on('coaches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('slot_user', function (Blueprint $table) {
            //
        });
    }
}
