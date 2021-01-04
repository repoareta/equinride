<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('owner');
            $table->string('manager');
            $table->string('contact_person');
            $table->string('contact_number');
            $table->unsignedInteger('capacity_of_stable');
            $table->unsignedInteger('capacity_of_arena');
            $table->unsignedInteger('number_of_coach');
            $table->string('address');
            $table->text('facilities')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stables');
    }
}
