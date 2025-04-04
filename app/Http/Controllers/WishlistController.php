<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Offer;

class WishlistController extends Controller
{
    // Add an offer to the user's wishlist
    public function add(Request $request)
    {
        // Validate the offer ID
        $request->validate([
            'offer_id' => 'required|exists:offers,id'
        ]);

        $user = Auth::user();

        // Create or find the user's wishlist
        $wishlist = Wishlist::firstOrCreate([
            'user_id' => $user->id
        ]);

        // Attach the offer if it is not already in the wishlist
        if (!$wishlist->offers()->where('offers.id', $request->offer_id)->exists()) {
            $wishlist->offers()->attach($request->offer_id);
        }

        return redirect()->route('offers.show', $request->offer_id)
            ->with('success', 'Offer added to your wishlist.');
    }

    // Remove an offer from the user's wishlist
    public function remove(Request $request)
    {
        // Validate the offer ID
        $request->validate([
            'offer_id' => 'required|exists:offers,id'
        ]);

        $user = Auth::user();

        // Find the user's wishlist
        $wishlist = Wishlist::firstOrCreate([
            'user_id' => $user->id
        ]);

        // Detach the offer if it exists in the wishlist
        if ($wishlist) {
            $wishlist->offers()->detach($request->offer_id);
        }

        return redirect()->route('offers.show', $request->offer_id)
            ->with('success', 'Offer removed from your wishlist.');
    }

    // Display the offers in the user's wishlist
    public function index()
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return response()->json(['message' => 'You must be logged in.'], 401);
        }

        // Retrieve the offers in the user's wishlist
        $wishlistedOffers = Wishlist::where('user_id', Auth::id())
            ->with('offer') // Load the associated offer data
            ->get();

        return view('wishlists.index', compact('wishlistedOffers'));
    }

    // Display the user's applications (postulations)
    public function candidatures()
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('home')->with('error', 'You must be logged in.');
        }

        // Retrieve the user's applications
        $postulations = Wishlist::where('user_id', Auth::id())->with('offer')->get();

        return view('wishlists.show', compact('postulations'));
    }
}
