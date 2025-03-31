<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Company;
use App\Models\Region;
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
            CountrySeeder::class,
            RegionSeeder::class,
            DepartementSeeder::class,
            CitySeeder::class,
            RolesAndPermissionsSeeder::class,
            UserSeeder::class,
            CompanySeeder::class,
        ]);
    }
}
