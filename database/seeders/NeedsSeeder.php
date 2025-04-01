<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Need;
use App\Models\Offer;
use App\Models\Skill;

class NeedsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch all offers and skills
        $offers = Offer::all();
        $skills = Skill::all();

        // Ensure there are offers and skills to associate
        if ($offers->isEmpty() || $skills->isEmpty()) {
            $this->command->info('No offers or skills found. Please seed offers and skills first.');
            return;
        }

        // Assign 2 to 5 random skills to each offer
        foreach ($offers as $offer) {
            $randomSkills = $skills->random(rand(2, 5));
            foreach ($randomSkills as $skill) {
                Need::create([
                    'offer_id' => $offer->id,
                    'skill_id' => $skill->id,
                ]);
            }
        }
    }
}