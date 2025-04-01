<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Work;
use App\Models\Company;
use App\Models\Sector;

class WorksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch all companies and sectors
        $companies = Company::all();
        $sectors = Sector::all();

        // Ensure there are companies and sectors to associate
        if ($companies->isEmpty() || $sectors->isEmpty()) {
            $this->command->info('No companies or sectors found. Please seed companies and sectors first.');
            return;
        }

        // Assign 2 to 5 random sectors to each company
        foreach ($companies as $company) {
            $randomSectors = $sectors->random(rand(2, 5));
            foreach ($randomSectors as $sector) {
                Work::create([
                    'company_id' => $company->id,
                    'sector_id' => $sector->id,
                ]);
            }
        }
    }
}