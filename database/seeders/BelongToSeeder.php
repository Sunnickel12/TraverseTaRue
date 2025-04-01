<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BelongTo;
use App\Models\User;
use App\Models\ClassModel;

class BelongToTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch all classes
        $classes = ClassModel::all();

        // Ensure there are classes to assign
        if ($classes->isEmpty()) {
            $this->command->info('No classes found. Please seed classes first.');
            return;
        }

        // Assign a class to each student
        $students = User::role('etudiant')->get();
        foreach ($students as $student) {
            BelongTo::create([
                'user_id' => $student->id,
                'classe_id' => $classes->random()->id,
            ]);
        }

        // Assign at least 2 classes to each pilot
        $pilots = User::role('pilote')->get();
        foreach ($pilots as $pilot) {
            $randomClasses = $classes->random(2);
            foreach ($randomClasses as $class) {
                BelongTo::create([
                    'user_id' => $pilot->id,
                    'classe_id' => $class->id,
                ]);
            }
        }
    }
}