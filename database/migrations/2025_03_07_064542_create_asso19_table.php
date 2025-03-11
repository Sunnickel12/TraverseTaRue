<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asso_19', function (Blueprint $table) {
            $table->foreignId('id_offer')->constrained('offers', 'id_offer');
            $table->foreignId('Id_Department')->constrained('departments', 'Id_Department');
            $table->primary(['id_offer', 'Id_Department']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asso_19');
    }
};