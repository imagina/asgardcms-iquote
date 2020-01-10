<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIquoteCharacteristicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iquote__characteristics', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('iquote__products')->onDelete('cascade');
            $table->integer('type')->default(0)->unsigned();
            $table->integer('parent_id')->default(0);
            $table->float('price');
            $table->boolean('active');
            $table->integer('position')->unsigned()->default(0);
            $table->boolean('required')->default(true);
            $table->integer('max')->nullable();
            $table->integer('min')->nullable();
            $table->boolean('with_notes')->default(false)->nullable();
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
        Schema::dropIfExists('iquote__characteristics');
    }
}
