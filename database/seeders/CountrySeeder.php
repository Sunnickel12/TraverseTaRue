<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ajouter la France
        Country::create(['name' => 'France']);

        // Ajouter les pays d'outre-mer (exemples)
        Country::create(['name' => 'Guadeloupe']);
        Country::create(['name' => 'Martinique']);
        Country::create(['name' => 'Réunion']);
        Country::create(['name' => 'Guyane']);
        Country::create(['name' => 'Mayotte']);
        Country::create(['name' => 'Polynésie française']);
        Country::create(['name' => 'Nouvelle-Calédonie']);
        Country::create(['name' => 'Wallis-et-Futuna']);
        Country::create(['name' => 'Saint-Pierre-et-Miquelon']);
        Country::create(['name' => 'Saint-Barthélemy']);
        Country::create(['name' => 'Saint-Martin']);
    }
}
