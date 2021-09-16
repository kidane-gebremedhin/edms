<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedocumenteditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_editions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('documentId');
            $table->integer('edition');
            $table->string('path');
            $table->double('sizeInBytes', 50, 2);
            $table->string('uploadedDateTime');
            //$table->integer('authorId');
            $table->integer('publisherId');
            $table->integer('yearOfPublishment');
            $table->text('description')->nullable();
            $table->integer('createdByUserId');
            $table->integer('updatedByUserId')->nullable();
            $table->string('isApproved')->default('false');
            $table->integer('view_count')->default(0);
            $table->integer('approvedByUserId')->nullable();
            $table->string('isDeleted')->default('false');
            $table->integer('deletedByUserId')->nullable();
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
        Schema::dropIfExists('document_editions');
    }
}
