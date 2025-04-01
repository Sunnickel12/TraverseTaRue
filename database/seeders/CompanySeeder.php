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
            ['name' => 'Robotic Systems', 'address' => '55 Rue de la Robotique', 'description' => 'Entreprise spécialisée en automatisation et robotique.', 'logo' => 'logo_robotic.jpg', 'email' => 'contact@robotic-systems.com', 'phone' => '01 23 45 67 89'],
            ['name' => 'TechNova', 'address' => '123 Rue des Inno', 'description' => 'Entreprise spécialisée en intelligence artificielle et cloud computing.', 'logo' => 'logo_technova.jpg', 'email' => 'info@technova.com', 'phone' => '02 34 56 78 90'],
            ['name' => 'Airbus', 'address' => '1 Rond-Point Maurice Bellonte, 31707 Blagnac Cedex', 'description' => 'Leader mondial de l’aéronautique, de l’espace et des services associés.', 'logo' => 'logo_airbus.png', 'email' => 'support@airbus.com', 'phone' => '05 61 93 33 33'],
            ['name' => 'Capgemini', 'address' => '11 Rue de Tilsitt, 75017 Paris', 'description' => 'Société internationale de services informatiques et de conseil.', 'logo' => 'logo_capgemini.png', 'email' => 'contact@capgemini.com', 'phone' => '01 47 54 50 00'],
            ['name' => 'CyberSecure', 'address' => '89 Rue de la Sécurité', 'description' => 'Entreprise de cybersécurité et protection des données.', 'logo' => 'logo_cybersecure.avif', 'email' => 'info@cybersecure.com', 'phone' => '01 56 78 90 12'],
            ['name' => 'Thales', 'address' => '31 Place des Corolles, 92400 Courbevoie', 'description' => 'Multinationale spécialisée dans l’électronique et la défense.', 'logo' => 'logo_thales.png', 'email' => 'info@thalesgroup.com', 'phone' => '01 40 00 77 00'],
            ['name' => 'AutoSoft', 'address' => '23 Rue des Algorithmes', 'description' => 'Développement de logiciels pour l’industrie automobile.', 'logo' => 'logo_autosoft.jpg', 'email' => 'contact@autosoft.com', 'phone' => '03 45 67 89 01'],
            ['name' => 'Google', 'address' => '8 Rue de Londres, 75009 Paris', 'description' => 'Entreprise multinationale spécialisée dans les services et produits liés à Internet.', 'logo' => 'logo_google.png', 'email' => 'paris@google.com', 'phone' => '01 23 45 67 89'],
            ['name' => 'Amazon', 'address' => '67 Boulevard du Général Leclerc, 92110 Clichy', 'description' => 'Société de commerce électronique et de services technologiques.', 'logo' => 'logo_amazon.png', 'email' => 'support@amazon.fr', 'phone' => '01 47 19 29 39'],
            ['name' => 'EduLearn', 'address' => '12 Rue du capitole', 'description' => 'Plateforme d’e-learning et formation en ligne.', 'logo' => 'logo_edulearn.png', 'email' => 'contact@edulearn.com', 'phone' => '04 67 89 01 23'],
            ['name' => 'FinanSoft', 'address' => '34 Place de la Bourse, 75002 Paris', 'description' => 'Développement d’outils financiers et gestion bancaire.', 'logo' => 'logo_finansoft.png', 'email' => 'info@finansoft.com', 'phone' => '01 53 45 60 70'],
            ['name' => 'SmartBuild', 'address' => '90 Rue de la Construction', 'description' => 'Logiciels et IA pour la gestion de bâtiments intelligents.', 'logo' => 'logo_smartbuild.png', 'email' => 'contact@smartbuild.com', 'phone' => '03 49 87 65 43'],
            ['name' => 'BioTech Solutions', 'address' => '22 Boulevard des Sciences', 'description' => 'Innovations en biotechnologie et recherche pharmaceutique.', 'logo' => 'logo_biotech_.avif', 'email' => 'info@biotech-solutions.com', 'phone' => '02 35 79 01 23'],
            ['name' => 'CloudSync', 'address' => '77 Rue du Cloud', 'description' => 'Fournisseur de solutions cloud computing et hébergement.', 'logo' => 'logo_cloudsync.png', 'email' => 'support@cloudsync.com', 'phone' => '03 45 67 32 10'],
            ['name' => 'GameDev Studio', 'address' => '11 Avenue du Jeu', 'description' => 'Développement de jeux vidéo et applications interactives.', 'logo' => 'logo_gamedev.jpg', 'email' => 'contact@gamedevstudio.com', 'phone' => '04 67 89 10 11']
        ]);
    }
}