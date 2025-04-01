<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Evaluation;
use App\Models\User;
use App\Models\Company;
use Faker\Factory as Faker;

class EvaluationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Fetch 30 random users and all companies
        $users = User::inRandomOrder()->take(30)->get();
        $companies = Company::all();

        // Ensure there are users and companies to evaluate
        if ($users->isEmpty() || $companies->isEmpty()) {
            $this->command->info('No users or companies found. Please seed users and companies first.');
            return;
        }

        // Create evaluations
        foreach ($users as $user) {
            foreach ($companies->random(3) as $company) { // Each user evaluates 3 random companies
                Evaluation::create([
                    'note' => $faker->numberBetween(1, 5), // Random note between 1 and 5
                    'comment' => $faker->optional()->sentence, // Optional comment
                    'user_id' => $user->id,
                    'company_id' => $company->id,
                ]);
            }
        }
    }
}