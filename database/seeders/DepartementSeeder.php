<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Departement;
use App\Models\Region;

class DepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departementsParRegion = [
            'Île-de-France' => ['Paris', 'Seine-et-Marne', 'Yvelines', 'Essonne', 'Hauts-de-Seine', 'Seine-Saint-Denis', 'Val-de-Marne', 'Val-d\'Oise'],
            'Provence-Alpes-Côte d\'Azur' => ['Alpes-de-Haute-Provence', 'Hautes-Alpes', 'Alpes-Maritimes', 'Bouches-du-Rhône', 'Var', 'Vaucluse'],
            'Auvergne-Rhône-Alpes' => ['Ain', 'Allier', 'Ardèche', 'Cantal', 'Drôme', 'Isère', 'Loire', 'Haute-Loire', 'Puy-de-Dôme', 'Rhône', 'Savoie', 'Haute-Savoie'],
            'Nouvelle-Aquitaine' => ['Charente', 'Charente-Maritime', 'Corrèze', 'Creuse', 'Dordogne', 'Gironde', 'Landes', 'Lot-et-Garonne', 'Pyrénées-Atlantiques', 'Deux-Sèvres', 'Vienne', 'Haute-Vienne'],
            'Bretagne' => ['Côtes-d\'Armor', 'Finistère', 'Ille-et-Vilaine', 'Morbihan'],
            'Hauts-de-France' => ['Aisne', 'Nord', 'Oise', 'Pas-de-Calais', 'Somme'],
            'Normandie' => ['Calvados', 'Eure', 'Manche', 'Orne', 'Seine-Maritime'],
            'Pays de la Loire' => ['Loire-Atlantique', 'Maine-et-Loire', 'Mayenne', 'Sarthe', 'Vendée'],
            'Centre-Val de Loire' => ['Cher', 'Eure-et-Loir', 'Indre', 'Indre-et-Loire', 'Loir-et-Cher', 'Loiret'],
            'Grand Est' => ['Ardennes', 'Aube', 'Marne', 'Haute-Marne', 'Meurthe-et-Moselle', 'Meuse', 'Moselle', 'Bas-Rhin', 'Haut-Rhin', 'Vosges'],
            'Occitanie' => ['Ariège', 'Aude', 'Aveyron', 'Gard', 'Haute-Garonne', 'Gers', 'Hérault', 'Lot', 'Lozère', 'Hautes-Pyrénées', 'Pyrénées-Orientales', 'Tarn', 'Tarn-et-Garonne'],
            'Bourgogne-Franche-Comté' => ['Côte-d\'Or', 'Doubs', 'Jura', 'Nièvre', 'Haute-Saône', 'Saône-et-Loire', 'Yonne', 'Territoire de Belfort'],
            'Corse' => ['Corse-du-Sud', 'Haute-Corse'],
            'Guadeloupe' => ['Guadeloupe'],
            'Martinique' => ['Martinique'],
            'Guyane' => ['Guyane'],
            'La Réunion' => ['La Réunion'],
            'Mayotte' => ['Mayotte'],
        ];

        foreach ($departementsParRegion as $regionName => $departements) {
            $region = Region::where('name', $regionName)->first();
            
            if ($region) { // Vérifie que la région existe bien avant d'insérer les départements
                foreach ($departements as $departementName) {
                    Departement::create([
                        'name' => $departementName,
                        'id_region' => $region->id_region
                    ]);
                }
            }
        }
    }
}
