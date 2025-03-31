<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('tittle', 255);
            $table->text('contenu');
            $table->decimal('salary', 20, 2);
            $table->string('level', 50);
            $table->string('start_date', 50);
            $table->string('end_date', 50);
            $table->string('duration', 50);
            $table->foreignId('city_id')->constrained()->onDelete('cascade');;
            $table->foreignId('company_id')->constrained()->onDelete('cascade');;
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};