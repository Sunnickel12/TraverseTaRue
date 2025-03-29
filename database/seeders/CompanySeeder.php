<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker; // Import de Faker
use App\Models\Company; // Assurez-vous d'importer le modèle Company

class CompanySeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create(); // Création d'une instance de Faker
        foreach (range(1, 5) as $index) {
            Company::create([
                'name' => $faker->company,
                'address' => $faker->address,
                'description' => $faker->paragraph,
                'logo' => $faker->imageUrl(),
                'email' => $faker->companyEmail,
                'phone' => $faker->phoneNumber,
            ]);
        }
    }
}
