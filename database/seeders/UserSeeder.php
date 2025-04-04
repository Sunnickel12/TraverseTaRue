<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; 
use Faker\Factory as Faker;


class UserSeeder extends Seeder
{
    /**
     * Exécuter le seeder.
     *
     * @return void
     */
    public function run()
    {


        $faker = Faker::create();

        // Création d'un utilisateur admin
        $admin = User::factory()->create([
            'name' => 'Admin',
            'first_name' => 'AdminFirst',
            'birthdate' => '1995-06-15',
            'email' => 'admin@example.com',
            'password' => bcrypt('c')
        ]);
        $admin->assignRole('admin');

        // Création d'un utilisateur pilote
        $pilot = User::factory()->create([
            'name' => 'Pilot',
            'first_name' => 'PilotFirst',
            'birthdate' => '1995-06-15',
            'email' => 'pilot@example.com',
            'password' => bcrypt('c')
        ]);
        $pilot->assignRole('pilote');

        // Création d'un utilisateur étudiant
        $student = User::factory()->create([
            'name' => 'Student',
            'first_name' => 'Thomas',
            'birthdate' => '1995-06-15',
            'email' => 'student@example.com',
            'password' => bcrypt('c')
        ]);
        $student->assignRole('etudiant');

        // Create 10 teachers
        for ($i = 0; $i < 10; $i++) {
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $teacher = User::factory()->create([
                'name' => $lastName,
                'first_name' => $firstName,
                'birthdate' => $faker->date('Y-m-d', '2000-01-01'),
                'email' => strtolower($firstName . '.' . $lastName . '@example.com'), // Generate email
                'password' => bcrypt('password'),
            ]);
            $teacher->assignRole('pilote');
        }

        // Create 50 students
        for ($i = 0; $i < 50; $i++) {
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $student = User::factory()->create([
                'name' => $lastName,
                'first_name' => $firstName,
                'birthdate' => $faker->date('Y-m-d', '2005-01-01'),
                'email' => strtolower($firstName . '.' . $lastName . '@example.com'), // Generate email
                'password' => bcrypt('password'),
                'classes_id' => $faker->numberBetween(1, 17), 
            ]);
            $student->assignRole('etudiant');
        }
    }
}
