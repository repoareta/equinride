<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixColumnToSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('slots', function (Blueprint $table) {
            $table->date('date');
            $table->time('time_start');
            $table->time('time_end');
            $table->unsignedBigInteger('capacity_booked');

            $table->dropColumn('package_id');
            $table->dropColumn('date_start');
            $table->dropColumn('date_end');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('slots', function (Blueprint $table) {
            $table->dropColumn('date');
            $table->dropColumn('time_start');
            $table->dropColumn('time_end');
            $table->dropColumn('capacity_booked');
        });
    }
}
