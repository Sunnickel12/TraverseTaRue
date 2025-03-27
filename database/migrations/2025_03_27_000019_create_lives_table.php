<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivesTable extends Migration
{
    public function up()
    {
        Schema::create('lives', function (Blueprint $table) {
            $table->unsignedBigInteger('id_users');
            $table->unsignedBigInteger('id_city');
            $table->primary(['id_users', 'id_city']);
            $table->foreign('id_users')->references('id_users')->on('users')->onDelete('cascade');
            $table->foreign('id_city')->references('id_city')->on('cities')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('lives');
    }
};