<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('needs', function (Blueprint $table) {
            $table->foreignId('id_offer')->constrained('offers', 'id_offer');
            $table->foreignId('id_skill')->constrained('skills', 'id_skill');
            $table->primary(['id_offer', 'id_skill']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('needs');
    }
};