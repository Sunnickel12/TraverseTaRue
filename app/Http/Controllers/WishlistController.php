<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
class WishlistController extends Controller
{
    public function add(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Vous devez être connecté.'], 401);
        }

        Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'offer_id' => $request->id_offers
        ]);

        return response()->json(['message' => 'Offre ajoutée à la wishlist']);
    }

    public function remove(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Vous devez être connecté.'], 401);
        }

        Wishlist::where('user_id', Auth::id())
            ->where('offer_id', $request->id_offers)
            ->delete();

        return response()->json(['message' => 'Offre retirée de la wishlist']);
    }
    // Afficher les offres de la wishlist
    public function index()
    {
        $wishlistedOffers = Wishlist::where('user_id', Auth::id())->with('offer')->get();
        return view('wishlist.index', compact('wishlistedOffers'));
    }
}
