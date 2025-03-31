<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country; 

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            'France',
            'Guadeloupe',
            'Martinique',
            'Réunion',
            'Guyane',
            'Mayotte',
            'Polynésie française',
            'Nouvelle-Calédonie',
            'Wallis-et-Futuna',
            'Saint-Pierre-et-Miquelon',
            'Saint-Barthélemy',
            'Saint-Martin'
        ];

        foreach ($countries as $country) {
            Country::updateOrCreate(
                ['name' => $country],
                ['name' => $country]
            );
        }
    }
}
