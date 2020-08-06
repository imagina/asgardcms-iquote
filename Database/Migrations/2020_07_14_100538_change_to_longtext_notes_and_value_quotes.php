<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeToLongtextNotesAndValueQuotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('iquote__quotes', function (Blueprint $table) {
            $table->longText('notes')->nullable();
            $table->longText('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('iquote__quotes', function (Blueprint $table) {
            $table->text('notes')->nullable();
            $table->text('value');
        });
    }
}
