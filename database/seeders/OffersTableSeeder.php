<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('offers')->insert([
            ['title' => 'Stage - Développeur Web', 'contenu' => "Développement d'applications web avec des technologies modernes", 'salary' => 500, 'niveau' => 'BAC+2', 'duree' => '6 mois', 'publication_date' => '10 jours','company_id' => 1],
            ['title' => 'Stage - Gestion de projets informatiques', 'contenu' => 'Gestion de projets, relation client, coordination des équipes', 'salary' => 800, 'niveau' => 'BAC+3', 'duree' => '4 mois', 'publication_date' => '15 jours','company_id' => 2],
            ['title' => 'Stage - Designer Graphique', 'contenu' => 'Création de visuels, logos, et supports marketing', 'salary' => 750, 'niveau' => 'BAC+2', 'duree' => '5 mois', 'publication_date' => '20 jours','company_id' => 3],
            ['title' => 'Stage - Data Analyst', 'contenu' => 'Analyse de données, création de rapports et recommandations stratégiques', 'salary' => 1200, 'niveau' => 'BAC+5', 'duree' => '6 mois', 'publication_date' => '5 jours','company_id' => 4],
            ['title' => 'Stage - Administrateur système', 'contenu' => 'Gestion et maintenance des infrastructures informatiques', 'salary' => 1500, 'niveau' => 'BAC+4', 'duree' => '6 mois', 'publication_date' => '12 jours','company_id' => 5]
            
        ]);
    }
}
