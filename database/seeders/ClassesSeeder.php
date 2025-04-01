<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassModel;

class ClassesTableSeeder extends Seeder
{
    public function run()
    {
        // Predefined categories and levels
        $categories = ['Info', 'S3E', 'BTP', 'Gene'];
        $levels = ['CPI A2', 'CPI A3', 'CPI A4', 'CPI A5'];

        // Insert classes for each category and level
        foreach ($categories as $category) {
            foreach ($levels as $level) {
                ClassModel::create([
                    'name' => "{$category} {$level}",
                ]);
            }
        }

        // Insert CPI A1 without categories
        ClassModel::create([
            'name' => 'CPI A1',
        ]);
    }
}