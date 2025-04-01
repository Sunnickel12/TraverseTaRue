<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Désactiver temporairement les contraintes de clé étrangère
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Insérer les classes dans la table `classes`
        DB::table('classes')->insert([
            ['name' => 'CPI A1', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'CPI A2', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'A3', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'A4', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'A5', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Réactiver les contraintes de clé étrangère
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
