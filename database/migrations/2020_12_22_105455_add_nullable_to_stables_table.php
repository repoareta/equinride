<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableToStablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stables', function (Blueprint $table) {
            $table->string('owner')->nullable()->change();
            $table->string('manager')->nullable()->change();
            $table->unsignedInteger('capacity_of_stable')->nullable()->change();
            $table->unsignedInteger('capacity_of_arena')->nullable()->change();
            $table->unsignedInteger('number_of_coach')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stables', function (Blueprint $table) {
            //
        });
    }
}
