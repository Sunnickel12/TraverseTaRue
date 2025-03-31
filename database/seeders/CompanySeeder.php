<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->insert([
            ['name' => 'Robotic Systems', 'address' => '55 Rue de la Robotique', 'description' => 'Entreprise spécialisée en automatisation et robotique.', 'logo' => 'logo_robotic.jpg'],
            [ 'name' => 'TechNova', 'address' => '123 Rue des Inno', 'description' => 'Entreprise spécialisée en intelligence artificielle et cloud computing.', 'logo' => 'logo_technova.jpg'],
            [ 'name' => 'Airbus', 'address' => '1 Rond-Point Maurice Bellonte, 31707 Blagnac Cedex', 'description' => 'Leader mondial de l’aéronautique, de l’espace et des services associés.', 'logo' => 'logo_airbus.png'],
            ['name' => 'Capgemini', 'address' => '11 Rue de Tilsitt, 75017 Paris', 'description' => 'Société internationale de services informatiques et de conseil.', 'logo' => 'logo_capgemini.png'],
            [ 'name' => 'CyberSecure', 'address' => '89 Rue de la Sécurité', 'description' => 'Entreprise de cybersécurité et protection des données.', 'logo' => 'logo_cybersecure.avif'],
            [ 'name' => 'Thales', 'address' => '31 Place des Corolles, 92400 Courbevoie', 'description' => 'Multinationale spécialisée dans l’électronique et la défense.', 'logo' => 'logo_thales.png'],
            ['name' => 'AutoSoft', 'address' => '23 Rue des Algorithmes', 'description' => 'Développement de logiciels pour l’industrie automobile.', 'logo' => 'logo_autosoft.jpg'],
            ['name' => 'Google', 'address' => '8 Rue de Londres, 75009 Paris', 'description' => 'Entreprise multinationale spécialisée dans les services et produits liés à Internet.', 'logo' => 'logo_google.png'],
            ['name' => 'Amazon', 'address' => '67 Boulevard du Général Leclerc, 92110 Clichy', 'description' => 'Société de commerce électronique et de services technologiques.', 'logo' => 'logo_amazon.png'],
            ['name' => 'EduLearn', 'address' => '12 Rue du capitole', 'description' => 'Plateforme d’e-learning et formation en ligne.', 'logo' => 'logo_edulearn.png'],
            ['name' => 'FinanSoft', 'address' => '34 Place de la Bourse, 75002 Paris', 'description' => 'Développement d’outils financiers et gestion bancaire.', 'logo' => 'logo_finansoft.png'],
            ['name' => 'SmartBuild', 'address' => '90 Rue de la Construction', 'description' => 'Logiciels et IA pour la gestion de bâtiments intelligents.', 'logo' => 'logo_smartbuild.png'],
            ['name' => 'BioTech Solutions', 'address' => '22 Boulevard des Sciences', 'description' => 'Innovations en biotechnologie et recherche pharmaceutique.', 'logo' => 'logo_biotech_.avif'],
            ['name' => 'CloudSync', 'address' => '77 Rue du Cloud', 'description' => 'Fournisseur de solutions cloud computing et hébergement.', 'logo' => 'logo_cloudsync.png'],
            [ 'name' => 'GameDev Studio', 'address' => '11 Avenue du Jeu', 'description' => 'Développement de jeux vidéo et applications interactives.', 'logo' => 'logo_gamedev.jpg']
        ]);
    }
}
