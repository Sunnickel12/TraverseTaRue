<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNeedsTable extends Migration
{
    public function up()
    {
        Schema::create('needs', function (Blueprint $table) {
            $table->unsignedBigInteger('id_offer');
            $table->unsignedBigInteger('id_skill');
            $table->primary(['id_offer', 'id_skill']);
            $table->foreign('id_offer')->references('id_offer')->on('offers')->onDelete('cascade');
            $table->foreign('id_skill')->references('id_skill')->on('skills')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('needs');
    }
};