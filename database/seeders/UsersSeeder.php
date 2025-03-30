<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Importation du modèle User

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Création d'un utilisateur admin
        $admin = User::factory()->create([
            'name' => 'Admin',
            'first_name' => 'AdminFirst',
            'email' => 'admin@example.com',
            'password' => bcrypt('password')
        ]);
        $admin->assignRole('admin');

        // Création d'un utilisateur pilote
        $pilot = User::factory()->create([
            'name' => 'Pilot',
            'first_name' => 'PilotFirst',
            'email' => 'pilot@example.com',
            'password' => bcrypt('password')
        ]);
        $pilot->assignRole('pilote');

        // Création d'un utilisateur étudiant
        $student = User::factory()->create([
            'name' => 'Student',
            'first_name' => 'Thomas',
            'email' => 'student@example.com',
            'password' => bcrypt('password')
        ]);
        $student->assignRole('etudiant');
    }
}
