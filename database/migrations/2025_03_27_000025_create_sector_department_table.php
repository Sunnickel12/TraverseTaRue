<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectorDepartmentTable extends Migration
{
    public function up()
    {
        Schema::create('sector_department', function (Blueprint $table) {
            $table->unsignedBigInteger('id_sectors');
            $table->unsignedBigInteger('Id_Department');
            $table->primary(['id_sectors', 'Id_Department']);
            $table->foreign('id_sectors')->references('id_sectors')->on('sectors')->onDelete('cascade');
            $table->foreign('Id_Department')->references('Id_Department')->on('departments')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sector_department');
    }
};