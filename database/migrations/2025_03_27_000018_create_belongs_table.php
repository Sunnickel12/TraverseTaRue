<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBelongsTable extends Migration
{
    public function up()
    {
        Schema::create('belongs', function (Blueprint $table) {
            $table->unsignedBigInteger('offer_id');
            $table->unsignedBigInteger('wishlist_id');
            $table->primary(['offer_id', 'wishlist_id']);
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade');
            $table->foreign('wishlist_id')->references('id')->on('wishlists')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('belongs');
    }
};