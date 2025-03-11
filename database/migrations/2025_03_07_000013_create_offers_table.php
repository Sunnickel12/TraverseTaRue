<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id('id_offer');
            $table->string('tittle', 255);
            $table->text('contenu');
            $table->decimal('salary', 20, 2);
            $table->timestamp('create_at');
            $table->foreignId('id_city')->constrained('cities', 'id_city');
            $table->foreignId('id_companie')->constrained('companies', 'id_companie');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};