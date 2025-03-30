<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;

class OfferController extends Controller
{
    public function index()
    {
        // Récupérer toutes les offres
        $offres = Offer::all();

        foreach ($offres as $offre) {
            $companyName = strtolower(str_replace(' ', '', $offre->company)); // Nom sans espace et en minuscules
            $logoPath = public_path('public/images/logo_' . $companyName . '.png'); // Chercher le logo .png

            // Si le logo .png n'existe pas, chercher le .jpg
            if (!file_exists($logoPath)) {
                $logoPath = 'public/images/logo_' . $companyName . '.jpg';
            } else {
                $logoPath = 'public/images/logo_' . $companyName . '.png';
            }

            // Ajouter le chemin du logo à chaque offre
            $offre->logo_path = $logoPath;
            
        }
        $offres = Offer::paginate(5);
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