<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lives', function (Blueprint $table) {
            $table->foreignId('id_users')->constrained('users', 'id_users');
            $table->foreignId('id_city')->constrained('cities', 'id_city');
            $table->primary(['id_users', 'id_city']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lives');
    }
};