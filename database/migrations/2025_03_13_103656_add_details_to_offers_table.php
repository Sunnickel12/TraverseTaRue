<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->string('niveau')->nullable();  // Niveau de qualification
            $table->string('duree')->nullable();   // Durée du stage
            $table->string('publication_date')->nullable(); // Date de publication
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->dropColumn(['niveau', 'duree', 'publication_date']);
        });
    }
};
