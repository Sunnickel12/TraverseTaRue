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
                'phone' => $faker->numerify('+33 #########'),
            ]);
        }

        // Generate additional companies using Faker
        $numberOfAdditionalCompanies = 50; // Define the number of additional companies to create
        for ($i = 0; $i < $numberOfAdditionalCompanies; $i++) {
            Company::create([
                'name' => $faker->unique()->company,
                'address' => $faker->address,
                'description' => $faker->paragraph,
                'logo' => 'default.png',
                'email' => $faker->unique()->companyEmail,
                'phone' => $faker->phoneNumber,
            ]);
        }
    }
}

