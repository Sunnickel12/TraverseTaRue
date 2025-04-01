<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sector;

class SectorSeeder extends Seeder
{
    public function run(): void
    {
        $sectors = [
            'Technologie de l\'information',
            'Ressources humaines',
            'Finance',
            'Marketing',
            'Ventes',
            'Santé',
            'Éducation',
            'Construction',
            'Fabrication',
            'Commerce de détail',
            'Transport',
            'Hôtellerie',
            'Énergie',
            'Télécommunications',
            'Juridique',
            'Immobilier',
            'Agriculture',
            'Divertissement',
            'Secteur public',
            'Recherche et développement',
        ];

        foreach ($sectors as $sectorName) {
            Sector::create([
                'name' => $sectorName,
            ]);
        }
    }
}
