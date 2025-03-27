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
            $table->string('level', 50);
            $table->string('start_date', 50);
            $table->string('end_date', 50);
            $table->string('duration', 50);
            $table->foreignId('id_city')->constrained('cities', 'id_city')->onDelete('cascade');
            $table->foreignId('id_company')->constrained('companies', 'id_company')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};