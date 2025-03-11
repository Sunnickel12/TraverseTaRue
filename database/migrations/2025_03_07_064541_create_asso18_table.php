<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asso_18', function (Blueprint $table) {
            $table->foreignId('id_users')->constrained('users', 'id_users');
            $table->foreignId('id_classes')->constrained('classes', 'id_classes');
            $table->primary(['id_users', 'id_classes']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asso_18');
    }
};