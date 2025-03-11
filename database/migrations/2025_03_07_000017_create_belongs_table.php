<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('belongs', function (Blueprint $table) {
            $table->foreignId('id_offer')->constrained('offers', 'id_offer');
            $table->foreignId('id_wishlist')->constrained('wishlists', 'id_wishlist');
            $table->primary(['id_offer', 'id_wishlist']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('belongs');
    }
};