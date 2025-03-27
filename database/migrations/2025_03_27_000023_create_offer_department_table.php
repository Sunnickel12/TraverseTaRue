<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferDepartmentTable extends Migration
{
    public function up()
    {
        Schema::create('offer_department', function (Blueprint $table) {
            $table->unsignedBigInteger('id_offer');
            $table->unsignedBigInteger('Id_Department');
            $table->primary(['id_offer', 'Id_Department']);
            $table->foreign('id_offer')->references('id_offer')->on('offers')->onDelete('cascade');
            $table->foreign('Id_Department')->references('Id_Department')->on('departments')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('offer_department');
    }
};