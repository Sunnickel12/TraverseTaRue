<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Offer;

class WishlistController extends Controller
{
    // Ajouter une offre à la wishlist
    public function add(Request $request)
    {
        $request->validate([
            'offer_id' => 'required|exists:offers,id'
        ]);

        $user = Auth::user();

        $wishlist = Wishlist::firstOrCreate([
            'user_id' => $user->id
        ]);

        // Attach only if not already attached
        if (!$wishlist->offers()->where('offers.id', $request->offer_id)->exists()) {
            $wishlist->offers()->attach($request->offer_id);
        }

        return redirect()->route('offers.show', $request->offer_id)
            ->with('success', 'Offre ajoutée à votre wishlist.');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'offer_id' => 'required|exists:offers,id'
        ]);

        $user = Auth::user();

        $wishlist = Wishlist::firstOrCreate([
            'user_id' => $user->id
        ]);

        if ($wishlist) {
            $wishlist->offers()->detach($request->offer_id);
        }

        return redirect()->route('offers.show', $request->offer_id)
            ->with('success', 'Offre retirée de votre wishlist.');
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
}
