<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CountrySeeder;
use Database\Seeders\RegionSeeder;
use Database\Seeders\DepartementSeeder;
use Database\Seeders\CitySeeder;
use Database\Seeders\RolesAndPermissionsSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\CompanySeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            // Seeders for geographical data
            CountrySeeder::class,
            RegionSeeder::class,
            DepartementSeeder::class,
            CitySeeder::class,

            // Seeders for roles and permissions
            RolesAndPermissionsSeeder::class,

            // Seeders for users and related data
            UserSeeder::class,
            ClassesTableSeeder::class,
            BelongToTableSeeder::class,

            // Seeders for companies and related data
            CompanySeeder::class,
            SituatesTableSeeder::class,
            WorksTableSeeder::class,

            // Seeders for offers and related data
            OffersTableSeeder::class,
            NeedsTableSeeder::class,
            DefinesTableSeeder::class,

            // Seeders for wishlists and related data
            WishlistsTableSeeder::class,
            BelongsTableSeeder::class,

            // Seeders for evaluations
            EvaluationsTableSeeder::class,

            // Seeders for additional data
            SkillsTableSeeder::class,
            SectorsTableSeeder::class,
            StatusesTableSeeder::class,
            LivesTableSeeder::class,
        ]);
    }
}
