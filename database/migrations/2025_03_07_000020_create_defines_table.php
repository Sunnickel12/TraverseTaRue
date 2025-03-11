<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('defines', function (Blueprint $table) {
            $table->foreignId('id_offer')->constrained('offers', 'id_offer');
            $table->foreignId('id_sectors')->constrained('sectors', 'id_sectors');
            $table->primary(['id_offer', 'id_sectors']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('defines');
    }
};