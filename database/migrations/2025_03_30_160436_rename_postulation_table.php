<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenamePostulationTable extends Migration
{
    public function up()
    {
        Schema::rename('postulation', 'postulations');
    }

    public function down()
    {
        Schema::rename('postulations', 'postulation');
    }
}

