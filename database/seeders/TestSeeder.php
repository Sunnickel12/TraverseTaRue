<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Seed Classes
        foreach (range(1, 4) as $index) {
            DB::table('classes')->insert([
                'name' => $faker->unique()->word, // Use Faker's unique() method here
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed Roles
        foreach (range(1, 4) as $index) {
            DB::table('roles')->insert([
                'name' => $faker->jobTitle,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed Users
        foreach (range(1, 4) as $index) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'first_name' => $faker->firstName,
                'birthdate' => $faker->date,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
                'pp' => $faker->imageUrl,
                'id_classes' => $faker->numberBetween(1, 2),
                'id_role' => $index,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed Companies
        foreach (range(1, 4) as $index) {
            DB::table('companies')->insert([
                'name' => $faker->company,
                'address' => $faker->address,
                'description' => $faker->paragraph,
                'logo' => $faker->imageUrl,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed Skills
        foreach (range(1, 4) as $index) {
            DB::table('skills')->insert([
                'name' => $faker->word,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed Countries
        foreach (range(1, 4) as $index) {
            DB::table('countries')->insert([
                'name' => $faker->country,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed Regions
        foreach (range(1, 4) as $index) {
            DB::table('regions')->insert([
                'name' => $faker->unique()->state,
                'id_country' => $index,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed Sectors
        foreach (range(1, 4) as $index) {
            DB::table('sectors')->insert([
                'name' => $faker->unique()->word,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed Departments
        foreach (range(1, 4) as $index) {
            DB::table('departments')->insert([
                'name' => $faker->unique()->word,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed Cities
        foreach (range(1, 4) as $index) {
            DB::table('cities')->insert([
                'name' => $faker->unique()->city,
                'id_region' => $index,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed Offers
        foreach (range(1, 4) as $index) {
            DB::table('offers')->insert([
                'tittle' => $faker->jobTitle,
                'contenu' => $faker->paragraph,
                'salary' => $faker->randomFloat(2, 30000, 100000),
                'create_at' => now(),
                'id_city' => $index,
                'id_companie' => $index,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed Evaluations
        foreach (range(1, 4) as $index) {
            DB::table('evaluations')->insert([
                'note' => $faker->randomFloat(1, 0, 5), // Ensure note is between 0 and 5
                'comment' => $faker->sentence,
                'create_at' => now(),
                'id_companie' => $index,
                'id_users' => $index,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed Wishlists
        foreach (range(1, 4) as $index) {
            DB::table('wishlists')->insert([
                'id_users' => $index,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed Postulations
        foreach (range(1, 4) as $index) {
            DB::table('postulations')->insert([
                'cv' => $faker->url,
                'motivation_letter' => $faker->paragraph,
                'status' => $faker->word,
                'id_users' => $index,
                'id_offer' => $index,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed Need
        foreach (range(1, 4) as $index) {
            DB::table('need')->insert([
                'id_offer' => $index,
                'id_skill' => $index,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed Situate
        foreach (range(1, 4) as $index) {
            DB::table('situate')->insert([
                'id_companie' => $index,
                'id_city' => $index,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed Belong
        foreach (range(1, 4) as $index) {
            DB::table('belongs')->insert([
                'id_offer' => $index,
                'id_wishlist' => $index,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed Live
        foreach (range(1, 4) as $index) {
            DB::table('lives')->insert([
                'id_users' => $index,
                'id_city' => $index,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed Work
        foreach (range(1, 4) as $index) {
            DB::table('works')->insert([
                'id_companie' => $index,
                'id_sectors' => $index,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed Define
        foreach (range(1, 4) as $index) {
            DB::table('defines')->insert([
                'id_offer' => $index,
                'id_sectors' => $index,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed Asso_18
        foreach (range(1, 4) as $index) {
            DB::table('asso_18')->insert([
                'id_users' => $index,
                'id_classes' => $index,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed Asso_19
        foreach (range(1, 4) as $index) {
            DB::table('asso_19')->insert([
                'id_offer' => $index,
                'Id_Department' => $index,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}