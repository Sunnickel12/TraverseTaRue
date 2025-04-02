<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Predefined list of statuses
        $statuses = [
            'En cours d\'examen',
            'Accepté',
            'Rejeté',
            'En attente',
            'Terminé',
            'En cours',
            'En pause',
            'Annulé',
            'Approuvé',
            'Refusé',
        ];

        // Insert statuses into the database
        foreach ($statuses as $statusName) {
            Status::create([
                'name' => $statusName,
            ]);
        }
    }
}
