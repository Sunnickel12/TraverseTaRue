<?php
namespace App\Http\Controllers;

use App\Models\Postulation;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Fetch the user's postulations
        $postulations = Postulation::where('id_users', $user->id_user)->with('offer')->get();

        // Fetch the user's wishlist
        $wishlist = Wishlist::where('id_users', $user->id_user)->get();

        // Return the view with data
        return view('users.dashboard', compact('postulations', 'wishlist'));
    }
}