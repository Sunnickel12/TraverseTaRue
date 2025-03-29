<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id('id_city');
            $table->string('name');
            $table->unsignedBigInteger('id_departement');
            $table->timestamps();

            $table->foreign('id_departement')->references('id_departement')->on('departements')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};