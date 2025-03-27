<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefinesTable extends Migration
{
    public function up()
    {
        Schema::create('defines', function (Blueprint $table) {
            $table->unsignedBigInteger('id_offer');
            $table->unsignedBigInteger('id_sectors');
            $table->primary(['id_offer', 'id_sectors']);
            $table->foreign('id_offer')->references('id_offer')->on('offers')->onDelete('cascade');
            $table->foreign('id_sectors')->references('id_sectors')->on('sectors')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('defines');
    }
};