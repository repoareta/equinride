<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApprovalToStablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stables', function (Blueprint $table) {
            $table->unsignedBigInteger('approval_by')->nullable();
            $table->dateTime('approval_at')->nullable();
            $table->string('approval_status')->nullable();

            $table->foreign('approval_by')->references('id')->on('users');
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
            $table->dropColumn('approval_by');
            $table->dropColumn('approval_at');
            $table->dropColumn('approval_status');
        });
    }
}
