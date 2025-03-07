<?php

// database/migrations/2024_03_07_000001_create_companies_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id('id_companie');
            $table->string('name', 75)->unique();
            $table->string('address', 255);
            $table->text('description');
            $table->string('logo', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('companies');
    }
}



// database/migrations/2024_03_07_000003_create_skills_table.php
class CreateSkillsTable extends Migration
{
    public function up()
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id('id_skill');
            $table->string('name', 58)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('skills');
    }
}

// database/migrations/2024_03_07_000004_create_classes_table.php
class CreateClassesTable extends Migration
{
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id('id_classes');
            $table->string('name', 13)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('classes');
    }
}

// database/migrations/2024_03_07_000005_create_countries_table.php
class CreateCountriesTable extends Migration
{
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id('id_country');
            $table->string('name', 56)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('countries');
    }
}

// database/migrations/2024_03_07_000006_create_regions_table.php
class CreateRegionsTable extends Migration
{
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->id('id_region');
            $table->string('name', 85)->unique();
            $table->foreignId('id_country')->constrained('countries');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('regions');
    }
}

// database/migrations/2024_03_07_000007_create_sectors_table.php
class CreateSectorsTable extends Migration
{
    public function up()
    {
        Schema::create('sectors', function (Blueprint $table) {
            $table->id('id_sectors');
            $table->string('name', 255)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sectors');
    }
}

// database/migrations/2024_03_07_000008_create_departments_table.php
class CreateDepartmentsTable extends Migration
{
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id('id_department');
            $table->string('name', 50)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('departments');
    }
}

// database/migrations/2024_03_07_000009_create_users_table.php
class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_users');
            $table->string('name', 47);
            $table->string('first_name', 35);
            $table->date('birthdate');
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->string('pp', 255);
            $table->foreignId('id_classes')->constrained('classes');
            $table->foreignId('id_role')->constrained('roles');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}

