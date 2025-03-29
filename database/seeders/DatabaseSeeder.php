<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;
use Database\Seeders\RolesAndPermissionsSeeder;


class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Appel de tous les seeders nécessaires
        $this->call([
            CompanySeeder::class,
            RolesAndPermissionsSeeder::class,
            SkillSeeder::class,
            ClassesSeeder::class,
            CountrySeeder::class,
            RegionSeeder::class,
            DepartementSeeder::class,
            CitySeeder::class,
            SectorSeeder::class,
            StatusSeeder::class,
            UsersSeeder::class,
            EvaluationSeeder::class,
            WishlistSeeder::class,
            OfferSeeder::class,
            PostulationSeeder::class,
            NeedSeeder::class,
            SituateSeeder::class,
            BelongSeeder::class,
            LiveSeeder::class,
            WorkSeeder::class,
            DefineSeeder::class,
            BelongToSeeder::class,
            PostulationStatusSeeder::class,
        ]);
    }
}