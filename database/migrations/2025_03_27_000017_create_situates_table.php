<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSituatesTable extends Migration
{
    public function up()
    {
        Schema::create('situates', function (Blueprint $table) {
            $table->unsignedBigInteger('id_company');
            $table->unsignedBigInteger('id_city');
            $table->primary(['id_company', 'id_city']);
            $table->foreign('id_company')->references('id_company')->on('companies')->onDelete('cascade');
            $table->foreign('id_city')->references('id_city')->on('cities')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('situates');
    }
};