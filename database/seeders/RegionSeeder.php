<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;
use App\Models\Country;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // France Métropolitaine
        $france = Country::where('name', 'France')->first();

        if ($france) { 
            $regionsMetropole = [
                'Île-de-France',
                'Provence-Alpes-Côte d\'Azur',
                'Auvergne-Rhône-Alpes',
                'Nouvelle-Aquitaine',
                'Bretagne',
                'Hauts-de-France',
                'Normandie',
                'Pays de la Loire',
                'Centre-Val de Loire',
                'Grand Est',
                'Occitanie',
                'Bourgogne-Franche-Comté',
                'Corse'
            ];

            foreach ($regionsMetropole as $regionName) {
                Region::create([
                    'name' => $regionName,
                    'country_id' => $france->id 
                ]);
            }
        }

        // France d'Outre-Mer
        $regionsOutreMer = [
            'Guadeloupe' => 'Guadeloupe',
            'Martinique' => 'Martinique',
            'La Réunion' => 'Réunion',
            'Guyane' => 'Guyane',
            'Mayotte' => 'Mayotte',
            'Polynésie Française' => 'Polynésie française',
            'Nouvelle-Calédonie' => 'Nouvelle-Calédonie',
            'Wallis-et-Futuna' => 'Wallis-et-Futuna',
            'Saint-Pierre-et-Miquelon' => 'Saint-Pierre-et-Miquelon',
            'Saint-Barthélemy' => 'Saint-Barthélemy',
            'Saint-Martin' => 'Saint-Martin'
        ];

        foreach ($regionsOutreMer as $regionName => $countryName) {
            $country = Country::where('name', $countryName)->first();

            if ($country) { 
                Region::create([
                    'name' => $regionName,
                    'country_id' => $country->id 
                ]);
            }
        }
    }
}
