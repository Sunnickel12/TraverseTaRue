<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Predefined list of statuses
        $statuses = [
            'Under Review',
            'Accepted',
            'Rejected',
            'Pending',
            'Completed',
            'In Progress',
            'On Hold',
            'Cancelled',
            'Approved',
            'Declined',
        ];

        // Insert statuses into the database
        foreach ($statuses as $statusName) {
            Status::create([
                'name' => $statusName,
            ]);
        }
    }
}