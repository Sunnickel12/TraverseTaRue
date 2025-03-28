<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CompanySeeder::class,
            RoleSeeder::class,
            SkillSeeder::class,
            ClassesSeeder::class,
            CountrySeeder::class,
            RegionSeeder::class,
            SectorSeeder::class,
            DepartmentSeeder::class,
            StatusSeeder::class,
            UsersSeeder::class,
            EvaluationSeeder::class,
            CitySeeder::class,
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
            OfferDepartmentSeeder::class,
            PostulationStatusSeeder::class,
            SectorDepartmentSeeder::class,
        ]);
    }
}
