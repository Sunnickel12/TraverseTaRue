<?php
namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WishlistController extends Controller
{
    // Ajouter une offre à la wishlist
    public function add(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Vous devez être connecté.'], 401);
        }

        $validator = Validator::make($request->all(), [
            'offer_id' => 'required|exists:offers,id' // Vérifie l'existence dans la table "offers"
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Offre invalide.'], 400);
        }

        Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'offer_id' => $request->offer_id
        ]);

        return response()->json(['message' => 'Offre ajoutée à la wishlist']);
    }

    // Retirer une offre de la wishlist
    public function remove(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Vous devez être connecté.'], 401);
        }

        $validator = Validator::make($request->all(), [
            'offer_id' => 'required|exists:offers,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Offre invalide.'], 400);
        }

        Wishlist::where('user_id', Auth::id())
            ->where('offer_id', $request->offer_id)
            ->delete();

        return response()->json(['message' => 'Offre retirée de la wishlist']);
    }

    // Afficher la wishlist de l'utilisateur
    public function index()
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Vous devez être connecté.'], 401);
        }

        $wishlistedOffers = Wishlist::where('user_id', Auth::id())
            ->with('offer') // Charge les offres associées
            ->get();

        return view('wishlists.index', compact('wishlistedOffers'));
    }

    // Afficher les candidatures (erreur corrigée)
    public function candidatures()
    {
        if (!Auth::check()) {
            return redirect()->route('home')->with('error', 'Vous devez être connecté.');
        }

        $postulations = Wishlist::where('user_id', Auth::id())->with('offer')->get();

        return view('wishlists.show', compact('postulations'));
    }

    // Afficher une offre spécifique dans la wishlist
    public function show(Wishlist $wishlist)
    {
        return view('wishlist.show', compact('wishlist'));
    }

    // Ajouter ou retirer une offre de la wishlist (toggle)
    public function toggle(Request $request)
{
    $user = auth()->user();  // Récupère l'utilisateur authentifié
    $offerId = $request->input('offer_id');  // Récupère l'ID de l'offre

    // Vérifier si la wishlist de l'utilisateur existe
    $wishlist = Wishlist::where('user_id', $user->id)->first();

    // Si la wishlist n'existe pas, en créer une
    if (!$wishlist) {
        $wishlist = Wishlist::create([
            'user_id' => $user->id,
        ]);
    }

    // Vérifier si l'offre est déjà dans la wishlist
    $offerInWishlist = $wishlist->offers()->where('offer_id', $offerId)->exists();

    if ($offerInWishlist) {
        // Si l'offre est déjà dans la wishlist, la retirer
        $wishlist->offers()->detach($offerId);
        return response()->json(['success' => true, 'action' => 'removed']);
    } else {
        // Ajouter l'offre à la wishlist
        $wishlist->offers()->attach($offerId);
        return response()->json(['success' => true, 'action' => 'added']);
    }
}


}
