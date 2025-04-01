<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sector;

class SectorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Predefined list of sectors
        $sectors = [
            'Information Technology',
            'Human Resources',
            'Finance',
            'Marketing',
            'Sales',
            'Healthcare',
            'Education',
            'Construction',
            'Manufacturing',
            'Retail',
            'Transportation',
            'Hospitality',
            'Energy',
            'Telecommunications',
            'Legal',
            'Real Estate',
            'Agriculture',
            'Entertainment',
            'Public Sector',
            'Research and Development',
        ];

        // Insert sectors into the database
        foreach ($sectors as $sectorName) {
            Sector::create([
                'name' => $sectorName,
            ]);
        }
    }
}