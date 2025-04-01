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
                'Corse',
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
                'Saint-Martin',
            ];

            foreach ($regionsMetropole as $regionName) {
                Region::create([
                    'name' => $regionName,
                    'country_id' => $france->id 
                ]);
            }
        }
    }
}
