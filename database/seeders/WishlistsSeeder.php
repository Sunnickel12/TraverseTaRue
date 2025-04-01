<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wishlist;
use App\Models\User;

class WishlistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch all users
        $users = User::all();

        // Ensure there are users to create wishlists for
        if ($users->isEmpty()) {
            $this->command->info('No users found. Please seed users first.');
            return;
        }

        // Create a wishlist for each user
        foreach ($users as $user) {
            Wishlist::create([
                'user_id' => $user->id,
            ]);
        }
    }
}