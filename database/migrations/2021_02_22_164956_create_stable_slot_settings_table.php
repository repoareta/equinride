<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStableSlotSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stable_slot_settings', function (Blueprint $table) {
            $table->unsignedBigInteger('stable_id');
            $table->unsignedBigInteger('closed_day');

            $table->foreign('stable_id')
                ->references('id')
                ->on('stables')
                ->onDelete('cascade');

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
        Schema::dropIfExists('stable_slot_settings');
    }
}
