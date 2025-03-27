<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_users');
            $table->string('name', 47);
            $table->string('first_name', 35);
            $table->date('birthdate');
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->string('pp', 255)->nullable();
            $table->foreignId('id_classes')->constrained('classes', 'id_classes')->onDelete('cascade');
            $table->foreignId('id_role')->constrained('roles', 'id_role')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};