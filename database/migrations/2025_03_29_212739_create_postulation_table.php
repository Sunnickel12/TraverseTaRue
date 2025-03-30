<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('postulation', function (Blueprint $table) {
            $table->bigIncrements('id_postulation');
            $table->unsignedBigInteger('id_users'); 
            $table->unsignedBigInteger('id_offers'); 
            $table->string('cv',255); 
            $table->string('motivation_letter',255); 
            $table->string('status',50)->default('Pending'); 
            $table->timestamps(); 
            // Définition des clés étrangères
            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_offers')->references('id_offers')->on('offers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('postulation');
    }
};
