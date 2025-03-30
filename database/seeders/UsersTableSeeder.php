<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Exécuter le seeder.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Vider la table users
        DB::table('users')->truncate();

        // Réactiver les vérifications des clés étrangères
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('users')->insert([
            ['name' => 'Dupont', 'first_name' => 'Jean', 'email' => 'jean.dupont@email.com', 'password' => bcrypt('password1')],
            ['name' => 'Martin', 'first_name' => 'Marie', 'email' => 'marie.martin@email.com', 'password' => bcrypt('password2')],
            ['name' => 'Lemoine', 'first_name' => 'Paul', 'email' => 'paul.lemoine@email.com', 'password' => bcrypt('password3')],
            ['name' => 'Bernard', 'first_name' => 'Sophie', 'email' => 'sophie.bernard@email.com', 'password' => bcrypt('password4')],
            ['name' => 'Lemoine', 'first_name' => 'Lucas', 'email' => 'lucas.lemoine@email.com', 'password' => bcrypt('password5')],
            ['name' => 'Lasalle', 'first_name' => 'Thomas', 'email' => 'muscu.thomas@email.com', 'password' => bcrypt('password6')],
            ['name' => 'Le goat', 'first_name' => 'Steven', 'email' => 'legoat.steven@email.com', 'password' => bcrypt('password7')],
            ['name' => 'La star', 'first_name' => 'Shayna', 'email' => 'lastar.shayna@email.com', 'password' => bcrypt('password8')],
            ['name' => 'Fournier', 'first_name' => 'Laura', 'email' => 'laura.fournier@email.com', 'password' => bcrypt('password9')],
            ['name' => 'Girard', 'first_name' => 'Pierre', 'email' => 'pierre.girard@email.com', 'password' => bcrypt('password10')],
            ['name' => 'Tremblay', 'first_name' => 'Lucie', 'email' => 'lucie.tremblay@email.com', 'password' => bcrypt('password11')],
            ['name' => 'Pires', 'first_name' => 'Antoine', 'email' => 'antoine.pires@email.com', 'password' => bcrypt('password12')],
            ['name' => 'Lemoine', 'first_name' => 'Sylvie', 'email' => 'sylvie.lemoine@email.com', 'password' => bcrypt('password13')],
            ['name' => 'Gauthier', 'first_name' => 'Julien', 'email' => 'julien.gauthier@email.com', 'password' => bcrypt('password14')],
            ['name' => 'Gauthier', 'first_name' => 'Peter', 'email' => 'peter.gauthier@email.com', 'password' => bcrypt('password15')],
        ]);
        
        
    }
}
