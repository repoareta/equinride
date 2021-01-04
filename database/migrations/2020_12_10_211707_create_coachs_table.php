<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coachs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stable_id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->date('birth_date');
            $table->string('sex');
            $table->string('contact_number');
            $table->unsignedInteger('experience');
            $table->string('certified');
            $table->string('photo')->nullable();
            $table->timestamps();

            $table->foreign('stable_id')->references('id')->on('stables');
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
        Schema::dropIfExists('coachs');
    }
}
