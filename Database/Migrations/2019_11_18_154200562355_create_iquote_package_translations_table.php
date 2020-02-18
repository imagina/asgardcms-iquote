<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIquotePackageTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iquote__package_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->integer('package_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['package_id', 'locale']);
            $table->foreign('package_id')->references('id')->on('iquote__packages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('iquote__package_translations', function (Blueprint $table) {
            $table->dropForeign(['package_id']);
        });
        Schema::dropIfExists('iquote__package_translations');
    }
}
