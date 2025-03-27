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
            $table->integer('note');
            $table->text('comment')->nullable();
            $table->foreignId('id_company')->constrained('companies', 'id_company')->onDelete('cascade');
            $table->foreignId('id_users')->constrained('users', 'id_users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};