<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lives', function (Blueprint $table) {
            $table->foreignId('id_user')->constrained('users', 'id_user')->onDelete('cascade');
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id_city')->on('cities')->onDelete('cascade');
            $table->primary(['id_user', 'city_id']);
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('lives');
    }
};
