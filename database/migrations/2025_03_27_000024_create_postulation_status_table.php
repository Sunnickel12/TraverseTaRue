<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostulationStatusTable extends Migration
{
    public function up()
    {
        Schema::create('postulation_status', function (Blueprint $table) {
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_offer');
            $table->unsignedBigInteger('id_postulation');
            $table->unsignedBigInteger('Id_Status');
            $table->primary(['id_user', 'id_offer', 'id_postulation', 'Id_Status']);
            
            // Correction : On fait référence à 'users' et non 'postulations'
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('Id_Status')->references('id_status')->on('statuses')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('postulation_status');
    }
};
