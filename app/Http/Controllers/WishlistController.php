<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WishlistController extends Controller
{
    // Ajouter une offre à la wishlist
    public function add(Request $request)
    {
        // Vérifier si l'utilisateur est authentifié
        if (!Auth::check()) {
            return response()->json(['message' => 'Vous devez être connecté.'], 401);
        }

        // Validation de l'ID de l'offre
        $validator = Validator::make($request->all(), [
            'id_offers' => 'required|exists:offres,id' // Vérifie si l'offre existe
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Offre invalide.'], 400);
        }

        // Ajouter l'offre à la wishlist si elle n'existe pas déjà
        Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'offer_id' => $request->id_offers
        ]);

        return response()->json(['message' => 'Offre ajoutée à la wishlist']);
    }

    // Retirer une offre de la wishlist
    public function remove(Request $request)
    {
        // Vérifier si l'utilisateur est authentifié
        if (!Auth::check()) {
            return response()->json(['message' => 'Vous devez être connecté.'], 401);
        }

        // Validation de l'ID de l'offre
        $validator = Validator::make($request->all(), [
            'id_offers' => 'required|exists:offres,id' // Vérifie si l'offre existe
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Offre invalide.'], 400);
        }

        // Supprimer l'offre de la wishlist
        Wishlist::where('user_id', Auth::id())
                ->where('offer_id', $request->id_offers)
                ->delete();

        return response()->json(['message' => 'Offre retirée de la wishlist']);
    }

    // Afficher les offres de la wishlist
    public function index()
    {
        // Vérifier si l'utilisateur est authentifié
        if (!Auth::check()) {
            return response()->json(['message' => 'Vous devez être connecté.'], 401);
        }

        // Récupérer les offres de la wishlist de l'utilisateur connecté
        $wishlistedOffers = Wishlist::where('user_id', Auth::id())
                                    ->with('offer') // Récupérer les données de l'offre associée
                                    ->get();

        return view('wishlist.index', compact('wishlistedOffers'));
    }
}
