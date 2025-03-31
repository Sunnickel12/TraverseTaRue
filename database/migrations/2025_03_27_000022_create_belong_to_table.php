<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBelongToTable extends Migration
{
    public function up()
    {
        Schema::create('belong_to', function (Blueprint $table) {
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('classe_id')->references('id')->on('classes')->onDelete('cascade');
            $table->primary(['user_id', 'classe_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('belong_to');
    }
};
