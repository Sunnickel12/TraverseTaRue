<?php

namespace App\Http\Controllers;

use App\Models\Postulation;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostulationController extends Controller
{
    // Affiche le formulaire de création de postulation
    public function create($offer_id)
    {
        $offer = Offer::findOrFail($offer_id); // Assurer que l'offre existe
        return view('postulations.create', compact('offer'));
    }

    // Enregistre une nouvelle postulation dans la base de données
    public function store(Request $request, $offer_id)
    {
        $request->validate([
            'mail' => 'required|email', // Validation de l'email
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'motivation' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'offer_id' => 'required|exists:offers,id',
        ]);

        $userId = Auth::id(); // ID de l'utilisateur connecté
        $offer = Offer::findOrFail($offer_id); // Assurer que l'offre existe

        // Sauvegarde du CV
        $cvPath = $request->file('cv')->store('cvs', 'public');

        // Sauvegarde de la lettre de motivation si elle est fournie
        $motivationLetterPath = $request->file('motivation')
            ? $request->file('motivation')->store('motivation_letters', 'public')
            : null;

        // Création de la postulation
        Postulation::create([
            'user_id' => $userId,
            'offer_id' => $offer_id,
            'cv' => $cvPath,
            'motivation_letter' => $motivationLetterPath,
            'status' => 'pending',
            'mail' => $request->input('mail'), // Ajout du mail
        ]);

        // Redirection avec message de succès
        return redirect()->route('offers.index')->with('success', 'Votre candidature a été enregistrée avec succès.');
    }

    // Les autres méthodes restent inchangées
}
