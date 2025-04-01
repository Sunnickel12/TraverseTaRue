<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\City;
use App\Models\Situate;

class SituatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch all companies and cities
        $companies = Company::all();
        $cities = City::all();

        // Ensure there are companies and cities to associate
        if ($companies->isEmpty() || $cities->isEmpty()) {
            $this->command->info('No companies or cities found. Please seed companies and cities first.');
            return;
        }

        // Assign multiple cities to each company
        foreach ($companies as $company) {
            $randomCities = $cities->random(rand(1, 5)); // Each company is situated in 1 to 5 random cities
            foreach ($randomCities as $city) {
                Situate::create([
                    'company_id' => $company->id,
                    'city_id' => $city->id,
                ]);
            }
        }
    }
}