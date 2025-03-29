<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartementsTable extends Migration{
    public function up(): void
    {
        Schema::create('departements', function (Blueprint $table) {
            $table->id('id_departement');
            $table->string('name')->unique();
            $table->foreignId('id_region')->constrained('regions', 'id_region');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departements');
        
    }
};
