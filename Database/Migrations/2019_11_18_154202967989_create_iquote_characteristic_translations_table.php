<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIquoteCharacteristicTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iquote__characteristic_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->text('options')->nullable();
            $table->integer('characteristic_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['characteristic_id', 'locale'], 'iquote__characteristic_id_locale_unique');
            $table->foreign('characteristic_id')->references('id')->on('iquote__characteristics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('iquote__characteristic_translations', function (Blueprint $table) {
            $table->dropForeign(['characteristic_id']);
        });
        Schema::dropIfExists('iquote__characteristic_translations');
    }
}
