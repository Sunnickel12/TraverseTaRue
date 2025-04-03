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
            'offer_id' => 'required|exists:offres,id' // Vérifie si l'offre existe
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Offre invalide.'], 400);
        }

        // Ajouter l'offre à la wishlist si elle n'existe pas déjà
        Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'offer_id' => $request->offer_id
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
            'offer_id' => 'required|exists:offres,id' // Vérifie si l'offre existe
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Offre invalide.'], 400);
        }

        // Supprimer l'offre de la wishlist
        Wishlist::where('user_id', Auth::id())
            ->where('offer_id', $request->offer_id)
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

        return view('wishlists.index', compact('wishlistedOffers'));
    }
    public function candidatures()
    {
        if (!Auth::check()) {
            return redirect()->route('home')->with('error', 'Vous devez être connecté.');
        }

        // Récupérer les candidatures de l'utilisateur connecté
        $postulations = Wishlist::where('user_id', Auth::id())->with('offer')->get();

        return view('wishlists.show', compact('postulations'));
    }
    public function show(wishlist $wishlist)
    {
        $wishlistOffer = Wishlist::find($wishlist->id);

        if (!$wishlistOffer) {
            return redirect()->route('wishlist.index')->with('error', 'Offre non trouvée');
        }

        return view('wishlist.show', compact('wishlistOffer'));
    }
    public function toggle(Request $request)
    {
        // Vérifie si l'utilisateur est authentifié
        if (!Auth::check()) {
            return response()->json(['error' => 'Vous devez être connecté.'], 401);
        }

        // Valider l'ID de l'offre
        $validated = $request->validate([
            'offer_id' => 'required|exists:offers,id',
        ]);

        // Rechercher ou créer une entrée dans la wishlist
        $wishlist = Wishlist::where('user_id', Auth::id())
            ->where('offer_id', $validated['offer_id'])
            ->first();

        if ($wishlist) {
            // Si l'offre est déjà dans la wishlist, la supprimer
            $wishlist->delete();

            return response()->json(['message' => 'Offre retirée de la wishlist', 'status' => 'removed']);
        } else {
            // Sinon, l'ajouter
            Wishlist::create([
                'user_id' => Auth::id(),
                'offer_id' => $validated['offer_id'],
            ]);

            return response()->json(['message' => 'Offre ajoutée à la wishlist', 'status' => 'added']);
        }
    }



}
