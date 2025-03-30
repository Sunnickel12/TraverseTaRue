<?php

namespace App\Http\Controllers;

use App\Models\Postulation;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostulationController extends Controller
{
    // Affiche le formulaire de postulation
    public function create($id_offers)
    {
        $offers = Offer::findOrFail($id_offers);
        return view('postulation.create', compact('offers'));
    }

    // Gère l'enregistrement de la postulation
    public function store(Request $request, $id_offers)
    {
        $request->validate([
            'cv' => 'required|file|mimes:pdf|max:2048',
            'motivation_letter' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Sauvegarde des fichiers dans "storage/app/public/"
        $cvPath = $request->file('cv')->store('cvs', 'public');
        $motivationLetterPath = $request->file('motivation_letter')
            ? $request->file('motivation_letter')->store('motivation_letters', 'public')
            : null;

        // Création de la postulation
        Postulation::create([
            'id_users' => Auth::id(),
            'id_offer' => $id_offers,
            'cv' => $cvPath,
            'motivation_letter' => $motivationLetterPath,
            'status' => 'Pending',
        ]);

        return redirect()->route('offres')->with('success', 'VPostulation successful !');
    }
}
