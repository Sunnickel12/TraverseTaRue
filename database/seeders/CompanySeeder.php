<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 5) as $index) {
            Company::create([
                'name' => $faker->company,
                'address' => $faker->address,
                'description' => $faker->paragraph,
                'logo' => $faker->imageUrl(),
                'email' => $faker->companyEmail,
                'phone' => $faker->phoneNumber,
            ]);
        }
    }
}
