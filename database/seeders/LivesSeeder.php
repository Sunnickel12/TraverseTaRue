<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Live;
use App\Models\User;
use App\Models\City;

class LivesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch all users and cities
        $users = User::all();
        $cities = City::all();

        // Ensure there are users and cities to associate
        if ($users->isEmpty() || $cities->isEmpty()) {
            $this->command->info('No users or cities found. Please seed users and cities first.');
            return;
        }

        // Assign a random city to each user
        foreach ($users as $user) {
            Live::create([
                'user_id' => $user->id,
                'city_id' => $cities->random()->id,
            ]);
        }
    }
}