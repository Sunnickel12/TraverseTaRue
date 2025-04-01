<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
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
            ['name' => 'Dupont', 'first_name' => 'Jean', 'birthdate' => '1990-01-15', 'email' => 'jean.dupont@email.com', 'password' => bcrypt('password1'), 'classes_id' => 1, 'pp' => 'pp_jean.jpg'],
            ['name' => 'Martin', 'first_name' => 'Marie', 'birthdate' => '1992-03-05', 'email' => 'marie.martin@email.com', 'password' => bcrypt('password2'), 'classes_id' => 2, 'pp' => 'pp_martin.jpg'],
            ['name' => 'Lemoine', 'first_name' => 'Paul', 'birthdate' => '1988-07-20', 'email' => 'paul.lemoine@email.com', 'password' => bcrypt('password3'), 'classes_id' => 3, 'pp' => 'pp_paul.jpg'],
            ['name' => 'Bernard', 'first_name' => 'Sophie', 'birthdate' => '1995-10-10', 'email' => 'sophie.bernard@email.com', 'password' => bcrypt('password4'), 'classes_id' => 3, 'pp' => 'pp_sophie.jpg'],
            ['name' => 'Lemoine', 'first_name' => 'Lucas', 'birthdate' => '1993-12-01', 'email' => 'lucas.lemoine@email.com', 'password' => bcrypt('password5'), 'classes_id' => 1, 'pp' => 'pp_lucas.jpg'],
            ['name' => 'Lasalle', 'first_name' => 'Thomas', 'birthdate' => '1990-05-25', 'email' => 'muscu.thomas@email.com', 'password' => bcrypt('password6'), 'classes_id' => 2, 'pp' => 'pp_thomas.jpg'],
            ['name' => 'Le goat', 'first_name' => 'Steven', 'birthdate' => '1991-03-12', 'email' => 'legoat.steven@email.com', 'password' => bcrypt('password7'), 'classes_id' => 2, 'pp' => 'pp_legoat.jpg'],
            ['name' => 'La star', 'first_name' => 'Shayna', 'birthdate' => '1996-08-22', 'email' => 'lastar.shayna@email.com', 'password' => bcrypt('password8'), 'classes_id' => 2, 'pp' => 'pp_shayna.jpg'],
            ['name' => 'Fournier', 'first_name' => 'Laura', 'birthdate' => '1992-11-30', 'email' => 'laura.fournier@email.com', 'password' => bcrypt('password9'), 'classes_id' => 2, 'pp' => 'pp_laura.jpg'],
            ['name' => 'Girard', 'first_name' => 'Pierre', 'birthdate' => '1989-04-08', 'email' => 'pierre.girard@email.com', 'password' => bcrypt('password10'), 'classes_id' => 3, 'pp' => 'pp_pierre.jpg'],
            ['name' => 'Tremblay', 'first_name' => 'Lucie', 'birthdate' => '1994-02-19', 'email' => 'lucie.tremblay@email.com', 'password' => bcrypt('password11'), 'classes_id' => 4, 'pp' => 'pp_lucie.jpg'],
            ['name' => 'Pires', 'first_name' => 'Antoine', 'birthdate' => '1993-07-16', 'email' => 'antoine.pires@email.com', 'password' => bcrypt('password12'), 'classes_id' => 1, 'pp' => 'pp_antoine.jpg'],
            ['name' => 'Lemoine', 'first_name' => 'Sylvie', 'birthdate' => '1987-09-03', 'email' => 'sylvie.lemoine@email.com', 'password' => bcrypt('password13'), 'classes_id' => 2, 'pp' => 'pp_sylvie.jpg'],
            ['name' => 'Gauthier', 'first_name' => 'Julien', 'birthdate' => '1995-06-15', 'email' => 'julien.gauthier@email.com', 'password' => bcrypt('password14'), 'classes_id' => 3, 'pp' => 'pp_julien.jpg'],
            ['name' => 'Gauthier', 'first_name' => 'Peter', 'birthdate' => '1991-09-21', 'email' => 'peter.gauthier@email.com', 'password' => bcrypt('password15'), 'classes_id' => 5, 'pp' => 'pp_peter.jpg'],
        ]);
        
        
    }
}
