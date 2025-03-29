<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker; 
use App\Models\Company; 

class CompanySeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $companiesWithLogos = [
            'TotalEnergies' => 'images/totalenergies.png',
            'LVMH' => 'images/lvmh.png',
            'Renault' => 'images/renault.png',
            'Airbus' => 'images/airbus.png',
            'Orange' => 'images/orange.png',
        ];

        foreach ($companiesWithLogos as $companyName => $logoPath) {
            Company::create([
                'name' => $companyName,
                'address' => $faker->address,
                'description' => $faker->paragraph,
                'logo' => $logoPath, 
                'email' => strtolower(str_replace(' ', '', $companyName)) . '@example.com',
                'phone' => $faker->phoneNumber,
            ]);
        }
    }
}
