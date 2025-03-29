<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Création des rôles
        $admin = Role::create(['name' => 'admin']);
        $pilote = Role::create(['name' => 'pilote']);
        $etudiant = Role::create(['name' => 'etudiant']);

        // Liste des permissions
        $permissions = [
            'authentifier',
            'rechercher_entreprise',
            'creer_entreprise',
            'modifier_entreprise',
            'evaluer_entreprise',
            'supprimer_entreprise',
            'consulter_stats_entreprises',
            'rechercher_offre',
            'creer_offre',
            'modifier_offre',
            'supprimer_offre',
            'consulter_stats_offres',
            'rechercher_pilote',
            'creer_pilote',
            'modifier_pilote',
            'supprimer_pilote',
            'rechercher_etudiant',
            'creer_etudiant',
            'modifier_etudiant',
            'supprimer_etudiant',
            'consulter_stats_etudiants',
            'ajouter_wishlist',
            'retirer_wishlist',
            'postuler_offre',
        ];

        // Création des permissions et attribution aux rôles
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Attribution des permissions aux rôles
        $admin->givePermissionTo(Permission::all());
        
        $pilote->givePermissionTo([
            'authentifier',
            'rechercher_entreprise', 'creer_entreprise', 'modifier_entreprise', 'evaluer_entreprise', 'supprimer_entreprise', 'consulter_stats_entreprises',
            'rechercher_offre', 'creer_offre', 'modifier_offre', 'supprimer_offre', 'consulter_stats_offres',
            'rechercher_etudiant', 'creer_etudiant', 'modifier_etudiant', 'supprimer_etudiant', 'consulter_stats_etudiants',
        ]);

        $etudiant->givePermissionTo([
            'authentifier',
            'rechercher_entreprise', 'evaluer_entreprise', 'consulter_stats_entreprises',
            'rechercher_offre', 'consulter_stats_offres',
            'ajouter_wishlist', 'retirer_wishlist', 'postuler_offre',
        ]);
    }
}