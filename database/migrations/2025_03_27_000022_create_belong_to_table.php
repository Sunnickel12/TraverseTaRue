<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBelongToTable extends Migration
{
    public function up()
    {
        Schema::create('belong_to', function (Blueprint $table) {
            // On n'a plus besoin de déclarer 'id_user' manuellement
            $table->foreignId('id_user')->constrained('users', 'id_user')->onDelete('cascade');
            $table->foreignId('id_classes')->constrained('classes', 'id_classes')->onDelete('cascade');
            $table->primary(['id_user', 'id_classes']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('belong_to');
    }
};
