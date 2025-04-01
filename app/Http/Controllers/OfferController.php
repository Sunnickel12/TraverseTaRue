<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;

class OfferController extends Controller
{
    public function index()
    {
        // Récupérer toutes les offres avec la relation 'company'
        $offres = Offer::with('company')->paginate(5); // Utilisation de with() pour charger la relation company

        foreach ($offres as $offre) {
            // Vérifier si l'offre a une société associée avant d'accéder à la propriété 'logo' ou 'name'
            if ($offre->company) {
                // Si la société existe, récupérer le chemin du logo et le nom de la société
                $offre->logo_path = 'images/' . $offre->company->logo ?? 'default_logo.png'; // logo ou logo par défaut
                $offre->company_name = $offre->company->name ?? 'Nom inconnu'; // Si le nom de la société est manquant
            } else {
                // Si la société n'existe pas, assigner un logo par défaut et un nom de société par défaut
                $offre->logo_path = 'images/default_logo.png';
                $offre->company_name = 'Nom inconnu';
            }
        }

        // Retourner la vue avec les offres
        return view('offres.index', compact('offres'));
    }

    // Affiche les détails d'une offre spécifique
    public function show($id_offers)
    {
        // Trouver l'offre par son ID
        $offre = Offer::where('id_offers', $id_offers)->firstOrFail();

        // Retourner la vue avec l'offre
        return view('offres.show', compact('offre')); // La vue 'offres.show' pour une seule offre
    }
}
?>