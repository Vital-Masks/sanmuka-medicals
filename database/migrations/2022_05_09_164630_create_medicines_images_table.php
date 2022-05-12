<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('medicine_id');
            $table->foreign('medicine_id')->references('id')
                ->on('medicines')->onDelete('cascade');
            $table->string('ImageName')->default('/img/products/noimage.png');
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
        Schema::dropIfExists('medicines_images');
    }
}
