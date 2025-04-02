<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorksTable extends Migration
{
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('sector_id');
            $table->primary(['company_id', 'sector_id']);
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('sector_id')->references('id')->on('sectors')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('works');
    }
};