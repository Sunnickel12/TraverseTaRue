<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostulationStatusTable extends Migration
{
    public function up()
    {
        Schema::create('postulation_status', function (Blueprint $table) {
            $table->unsignedBigInteger('id_users');
            $table->unsignedBigInteger('id_offer');
            $table->unsignedBigInteger('id_postulation');
            $table->unsignedBigInteger('Id_Status');
            $table->primary(['id_users', 'id_offer', 'id_postulation', 'Id_Status']);
            $table->foreign('id_users')->references('id_users')->on('postulations')->onDelete('cascade');
            $table->foreign('Id_Status')->references('Id_Status')->on('statuses')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('postulation_status');
    }
};