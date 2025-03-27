<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBelongsTable extends Migration
{
    public function up()
    {
        Schema::create('belongs', function (Blueprint $table) {
            $table->unsignedBigInteger('id_offer');
            $table->unsignedBigInteger('id_wishlist');
            $table->primary(['id_offer', 'id_wishlist']);
            $table->foreign('id_offer')->references('id_offer')->on('offers')->onDelete('cascade');
            $table->foreign('id_wishlist')->references('id_wishlist')->on('wishlists')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('belongs');
    }
};