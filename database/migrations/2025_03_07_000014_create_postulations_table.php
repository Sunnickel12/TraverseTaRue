<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('postulations', function (Blueprint $table) {
            $table->id('id_postulation');
            $table->string('cv', 255);
            $table->string('motivation_letter', 255)->nullable();
            $table->string('status', 15);
            $table->timestamp('create_at');
            $table->foreignId('id_users')->constrained('users', 'id_users');
            $table->foreignId('id_offer')->constrained('offers', 'id_offer');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('postulations');
    }
};