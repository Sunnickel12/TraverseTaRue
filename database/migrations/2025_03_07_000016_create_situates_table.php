<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('situates', function (Blueprint $table) {
            $table->foreignId('id_companie')->constrained('companies', 'id_companie');
            $table->foreignId('id_city')->constrained('cities', 'id_city');
            $table->primary(['id_companie', 'id_city']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('situates');
    }
};