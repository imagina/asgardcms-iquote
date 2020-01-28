<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSearcheableFieldToCharacteristicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('iquote__characteristics', function (Blueprint $table) {
          $table->boolean('searcheable')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('iquote__characteristics', function (Blueprint $table) {
          $table->dropColumn('searcheable');
        });
    }
}
