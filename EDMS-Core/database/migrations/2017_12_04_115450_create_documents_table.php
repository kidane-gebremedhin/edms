<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('category');
            $table->string('subCategory');
            $table->text('summery')->nullable();
            $table->text('location')->nullable();
            //$table->float('sizeInBytes');
            $table->string('uploadedDateTime');
            $table->integer('authorId');
            //$table->integer('publisherId');
            //$table->integer('yearOfPublishment');
            // $table->string('edition');
            //$table->text('description')->nullable();
            $table->integer('createdByUserId');
            $table->integer('updatedByUserId')->nullable();
            $table->string('isPermissionApproved')->default('false');
            $table->string('isApproved')->default('false');
            $table->integer('approvedByUserId')->nullable();
            $table->string('isArchived')->default('false');
            $table->integer('archivedByUserId')->nullable();
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
        Schema::dropIfExists('documents');
    }
}
