<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['id_role' => 1, 'name' => 'user'],
            ['id_role' => 2, 'name' => 'pilote'],
            ['id_role' => 3, 'name' => 'admin'],
        ]);
    }
}
