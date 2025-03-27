<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorksTable extends Migration
{
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->unsignedBigInteger('id_company');
            $table->unsignedBigInteger('id_sectors');
            $table->primary(['id_company', 'id_sectors']);
            $table->foreign('id_company')->references('id_company')->on('companies')->onDelete('cascade');
            $table->foreign('id_sectors')->references('id_sectors')->on('sectors')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('works');
    }
};