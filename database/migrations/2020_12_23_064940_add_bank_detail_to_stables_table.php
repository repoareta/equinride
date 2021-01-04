<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBankDetailToStablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stables', function (Blueprint $table) {
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('branch')->nullable();
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
            $table->dropColumn('account_name');
            $table->dropColumn('account_number');
            $table->dropColumn('branch');
        });
    }
}
