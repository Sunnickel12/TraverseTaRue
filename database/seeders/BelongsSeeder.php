<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Belong;
use App\Models\Offer;
use App\Models\Wishlist;

class BelongsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch all wishlists and offers
        $wishlists = Wishlist::all();
        $offers = Offer::all();

        // Ensure there are wishlists and offers to associate
        if ($wishlists->isEmpty() || $offers->isEmpty()) {
            $this->command->info('No wishlists or offers found. Please seed wishlists and offers first.');
            return;
        }

        // Assign 4 to 7 random offers to each wishlist
        foreach ($wishlists as $wishlist) {
            $randomOffers = $offers->random(rand(4, 7));
            foreach ($randomOffers as $offer) {
                Belong::create([
                    'offer_id' => $offer->id,
                    'wishlist_id' => $wishlist->id,
                ]);
            }
        }
    }
}