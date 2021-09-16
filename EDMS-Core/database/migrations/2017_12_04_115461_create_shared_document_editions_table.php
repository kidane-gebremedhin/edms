<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateshareddocumenteditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shared_document_editions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('documentId');
            $table->integer('sharedByUserId');
            $table->integer('sharedToUserId');
            $table->string('isViewed')->default('false');
            $table->string('isViewedByAdmin')->default('false');
            $table->string('sharedDateTime');
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
        Schema::dropIfExists('shared_document_editions');
    }
}
