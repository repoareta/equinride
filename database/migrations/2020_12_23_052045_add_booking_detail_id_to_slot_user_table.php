<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBookingDetailIdToSlotUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('slot_user', function (Blueprint $table) {
            $table->unsignedBigInteger('booking_detail_id')->nullable();

            $table->foreign('booking_detail_id')->references('id')->on('booking_details');
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
            $table->dropColumn('booking_detail_id');
        });
    }
}
