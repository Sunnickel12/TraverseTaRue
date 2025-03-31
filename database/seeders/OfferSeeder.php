<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            // Supprimer les anciennes données
            DB::table('offers')->truncate();

            // Réactiver les contraintes de clé étrangère
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('offers')->insert([
            ['title' => 'Stage - Développeur Web', 'contenu' => "Développement d'applications web avec des technologies modernes", 'salary' => 500, 'level' => 'BAC+2', 'duration' => '6 mois', 'start_date' => '10 jours','company_id' => 1],
            ['title' => 'Stage - Gestion de projets informatiques', 'contenu' => 'Gestion de projets, relation client, coordination des équipes', 'salary' => 800, 'level' => 'BAC+3', 'duration' => '4 mois', 'start_date' => '15 jours','company_id' => 2],
            ['title' => 'Stage - Designer Graphique', 'contenu' => 'Création de visuels, logos, et supports marketing', 'salary' => 750, 'level' => 'BAC+2', 'duration' => '5 mois', 'start_date' => '20 jours','company_id' => 3],
            ['title' => 'Stage - Data Analyst', 'contenu' => 'Analyse de données, création de rapports et recommandations stratégiques', 'salary' => 1200, 'level' => 'BAC+5', 'duration' => '6 mois', 'start_date' => '5 jours','company_id' => 4],
            ['title' => 'Stage - Administrateur système', 'contenu' => 'Gestion et maintenance des infrastructures informatiques', 'salary' => 1500, 'level' => 'BAC+4', 'duration' => '6 mois', 'start_date' => '12 jours','company_id' => 5],
            ['title' => 'Stage - Développeur mobile', 'contenu' => "Création d'applications pour smartphones et tablettes", 'salary' => 1234, 'level' => 'BAC+2', 'duration' => '4 mois', 'start_date' => '7 jours', 'company_id' => 6],
            ['title' => 'Stage - Product Manager', 'contenu' => "Gestion du cycle de vie d'un produit, de la conception à la commercialisation", 'salary' => 765, 'level' => 'BAC+5', 'duration' => '5 mois', 'start_date' => '10 jours', 'company_id' => 7],
            ['title' => 'Stage - Ingénieur réseaux', 'contenu' => 'Maintenance et sécurisation des réseaux informatiques', 'salary' => 876, 'level' => 'BAC+4', 'duration' => '6 mois', 'start_date' => '9 jours', 'company_id' => 8],
            ['title' => 'Stage - Consultant IT', 'contenu' => 'Conseils en informatique et gestion de projets technologiques', 'salary' => 543, 'level' => 'BAC+5', 'duration' => '6 mois', 'start_date' => '11 jours', 'company_id' => 9],
            ['title' => 'Stage - Community Manager', 'contenu' => 'Gestion des réseaux sociaux et de la communication en ligne', 'salary' => 500, 'level' => 'BAC+3', 'duration' => '3 mois', 'start_date' => '6 jours', 'company_id' => 10],
            ['title' => 'Stage - Rédacteur Web', 'contenu' => 'Rédaction de contenus optimisés pour le SEO', 'salary' => 1580, 'level' => 'BAC', 'duration' => '4 mois', 'start_date' => '14 jours', 'company_id' => 11],
            ['title' => 'Stage - Consultant en stratégie', 'contenu' => 'Accompagnement des entreprises dans leur stratégie de croissance', 'salary' => 764, 'level' => 'BAC+5', 'duration' => '5 mois', 'start_date' => '15 min', 'company_id' => 12],
            ['title' => 'Stage - Responsable RH', 'contenu' => 'Gestion des ressources humaines et recrutement', 'salary' => 1430, 'level' => 'BAC+4', 'duration' => '6 mois', 'start_date' => '13 jours', 'company_id' => 13],
            ['title' => 'Stage - Industrialisation', 'contenu' => 'Gestion des produits, analyse des tendances du marché et lancement de nouveaux produits', 'salary' => 1340, 'level' => 'BAC+5', 'duration' => '6 mois', 'start_date' => '18 jours', 'company_id' => 14],
        ]);
    }
}
