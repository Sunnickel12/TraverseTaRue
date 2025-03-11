<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id('id_companie');
            $table->string('name', 75)->unique();
            $table->string('address', 255);
            $table->text('description');
            $table->string('logo', 255);
            $table->string('email', 50)->nullable();
            $table->string('phone', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};