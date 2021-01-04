<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPedigreeToHorsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('horses', function (Blueprint $table) {
            $table->string('pedigree_male')->nullable();
            $table->string('pedigree_female')->nullable();

            $table->dropColumn('pedigree');
            $table->dropColumn('breeds');

            $table->string('passport_number')->nullable()->change();
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
            $table->dropColumn('pedigree_male');
            $table->dropColumn('pedigree_female');
        });
    }
}
