<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Offer;
use App\Models\City;
use App\Models\Company;
use Faker\Factory as Faker;

class OffersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Fetch all cities and companies
        $cities = City::all();
        $companies = Company::all();

        // Ensure there are cities and companies to associate with offers
        if ($cities->isEmpty() || $companies->isEmpty()) {
            $this->command->info('No cities or companies found. Please seed cities and companies first.');
            return;
        }

        // Create 100 offers
        for ($i = 0; $i < 100; $i++) {
            Offer::create([
                'title' => $faker->jobTitle,
                'contenu' => $faker->paragraphs(3, true),
                'salary' => $faker->randomFloat(2, 600, 1200), 
                'level' => $faker->randomElement(['3eme', 'Bac+1', 'Bac+2', 'Bac+3', 'Bac+4', 'Bac+5']),
                'start_date' => $faker->dateTimeBetween('now', '+4 month')->format('Y-m-d'),
                'end_date' => $faker->dateTimeBetween('+3 months', '+6 months')->format('Y-m-d'),
                'duration' => $faker->randomElement(['1 mois', '3 mois', '6 mois']), //other table
                'city_id' => $cities->random()->id,
                'company_id' => $companies->random()->id,
                'created_at' => now(),
            ]);
        }
    }
}