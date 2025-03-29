<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\Departement;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Liste des principales villes par département
        $villesParDepartement = [
            'Paris' => ['Paris'],
            'Seine-et-Marne' => ['Melun', 'Meaux'],
            'Yvelines' => ['Versailles', 'Mantes-la-Jolie'],
            'Essonne' => ['Évry', 'Corbeil-Essonnes'],
            'Hauts-de-Seine' => ['Nanterre', 'Boulogne-Billancourt'],
            'Seine-Saint-Denis' => ['Bobigny', 'Saint-Denis'],
            'Val-de-Marne' => ['Créteil', 'Vitry-sur-Seine'],
            'Val-d\'Oise' => ['Pontoise', 'Argenteuil'],
            'Bouches-du-Rhône' => ['Marseille', 'Aix-en-Provence'],
            'Alpes-Maritimes' => ['Nice', 'Cannes'],
            'Rhône' => ['Lyon', 'Villeurbanne'],
            'Gironde' => ['Bordeaux', 'Mérignac'],
            'Haute-Garonne' => ['Toulouse', 'Colomiers'],
            'Hérault' => ['Montpellier', 'Béziers'],
            'Nord' => ['Lille', 'Roubaix'],
            'Loire-Atlantique' => ['Nantes', 'Saint-Nazaire'],
            'Bas-Rhin' => ['Strasbourg', 'Haguenau'],
            'Isère' => ['Grenoble', 'Échirolles'],
            'Finistère' => ['Brest', 'Quimper'],
            'Ille-et-Vilaine' => ['Rennes', 'Saint-Malo'],
            'Loire' => ['Saint-Étienne', 'Roanne'],
            'Pyrénées-Atlantiques' => ['Pau', 'Bayonne'],
            'Calvados' => ['Caen', 'Lisieux'],
            'Côte-d\'Or' => ['Dijon', 'Beaune'],
            'Moselle' => ['Metz', 'Thionville'],
            'Vaucluse' => ['Avignon', 'Carpentras'],
            'Maine-et-Loire' => ['Angers', 'Cholet'],
            'Oise' => ['Beauvais', 'Compiègne'],
            'Doubs' => ['Besançon', 'Montbéliard'],
            'Var' => ['Toulon', 'Hyères'],
            'Haute-Vienne' => ['Limoges', 'Saint-Junien'],
            'Somme' => ['Amiens', 'Abbeville'],
            'Charente-Maritime' => ['La Rochelle', 'Rochefort'],
            'Aude' => ['Carcassonne', 'Narbonne'],
            'Guadeloupe' => ['Pointe-à-Pitre', 'Basse-Terre'],
            'Martinique' => ['Fort-de-France', 'Le Lamentin'],
            'Guyane' => ['Cayenne', 'Saint-Laurent-du-Maroni'],
            'La Réunion' => ['Saint-Denis', 'Saint-Pierre'],
            'Mayotte' => ['Mamoudzou', 'Dzaoudzi']
        ];

        foreach ($villesParDepartement as $departementName => $villes) {
            $departement = Departement::where('name', $departementName)->first();

            if ($departement) { // Vérifie que le département existe avant d'insérer ses villes
                foreach ($villes as $ville) {
                    $this->createCityIfNotExists($ville, $departement->id_departement);
                }
            }
        }
    }

    private function createCityIfNotExists($cityName, $departementId)
    {
        // Vérifier si la ville existe déjà avant de l'ajouter
        $existingCity = City::where('name', $cityName)
                            ->where('id_departement', $departementId)
                            ->first();
    
        if (!$existingCity) {
            City::create([
                'name' => $cityName,
                'id_departement' => $departementId
            ]);
        }
    }
}   
