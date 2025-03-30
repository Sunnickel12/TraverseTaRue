<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostulationStatusTable extends Migration
{
    public function up()
    {
        Schema::create('postulation_status', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('offer_id');
            $table->unsignedBigInteger('postulation_id');
            $table->unsignedBigInteger('statuse_id');
            $table->primary(['user_id', 'offer_id', 'postulation_id', 'statuse_id']);
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('statuse_id')->references('id')->on('statuses')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('postulation_status');
    }
};
