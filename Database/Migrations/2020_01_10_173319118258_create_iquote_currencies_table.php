<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIquoteCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iquote__currencies', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('code');
            $table->string('symbol_left')->nullable();
            $table->string('symbol_right')->nullable();
            $table->char('decimal_place', 1)->nullable();
            $table->double('value', 15, 8);
            $table->tinyInteger('status')->default(0)->unsigned();
            $table->boolean('default_currency')->default(false);
            $table->text('options')->default('')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('iquote__currencies');
    }
}
