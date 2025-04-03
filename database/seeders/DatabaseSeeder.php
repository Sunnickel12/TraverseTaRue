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
use Database\Seeders\SituatesSeeder;
use Database\Seeders\WorksSeeder;
use Database\Seeders\OffersSeeder;
use Database\Seeders\NeedsSeeder;
use Database\Seeders\DefinesSeeder;
use Database\Seeders\WishlistsSeeder;
use Database\Seeders\BelongsSeeder;
use Database\Seeders\EvaluationsSeeder;
use Database\Seeders\SkillsSeeder;
use Database\Seeders\SectorSeeder;
use Database\Seeders\StatusesSeeder;
use Database\Seeders\LivesSeeder;
use Database\Seeders\BelongToSeeder;
use Database\Seeders\ClasseSeeder;



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
            ClasseSeeder::class,
            UserSeeder::class,


            BelongToSeeder::class,

            CompanySeeder::class,
            OffersSeeder::class,
            SkillsSeeder::class,
            WishlistsSeeder::class,
            SectorSeeder::class,
            StatusesSeeder::class,

            // Seeders for companies and related data
          
            SituatesSeeder::class,
            WorksSeeder::class,

            // Seeders for offers and related data
            
            NeedsSeeder::class,
            DefinesSeeder::class,

            // Seeders for wishlists and related data

            BelongsSeeder::class,

            // Seeders for evaluations
            EvaluationsSeeder::class,

            // Seeders for additional data
  

            LivesSeeder::class,

        ]);
        
    }
}
