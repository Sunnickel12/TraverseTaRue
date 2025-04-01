<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Define;
use App\Models\Offer;
use App\Models\Sector;

class DefinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch all offers and sectors
        $offers = Offer::all();
        $sectors = Sector::all();

        // Ensure there are offers and sectors to associate
        if ($offers->isEmpty() || $sectors->isEmpty()) {
            $this->command->info('No offers or sectors found. Please seed offers and sectors first.');
            return;
        }

        // Assign 1 to 3 random sectors to each offer
        foreach ($offers as $offer) {
            $randomSectors = $sectors->random(rand(1, 3));
            foreach ($randomSectors as $sector) {
                Define::create([
                    'id_offer' => $offer->id,
                    'id_sector' => $sector->id,
                ]);
            }
        }
    }
}