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
            'TotalEnergies' => 'totalenergies.png',
            'LVMH' => 'lvmh.png',
            'Renault' => 'renault.png',
            'Airbus' => 'airbus.png',
            'Orange' => 'orange.png',
        ];

        foreach ($companiesWithLogos as $companyName => $logoPath) {
           company::Create([
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
