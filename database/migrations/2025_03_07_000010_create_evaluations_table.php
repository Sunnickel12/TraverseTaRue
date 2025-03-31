<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id('id_evaluation');
            $table->decimal('note', 2, 1);
            $table->text('comment')->nullable();
            $table->timestamp('create_at');
            $table->foreignId('id_companie')->constrained('companies', 'id_companie');
            $table->foreignId('id_users')->constrained('users', 'id_users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};