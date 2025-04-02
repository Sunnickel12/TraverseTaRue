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
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'motivation_letter' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $userId = Auth::id(); // ID de l'utilisateur connecté

        // Sauvegarde du CV
        $cvPath = $request->file('cv')->store('cvs', 'public');

        // Sauvegarde de la lettre de motivation si elle est fournie
        $motivationLetterPath = $request->file('motivation_letter')
            ? $request->file('motivation_letter')->store('motivation_letters', 'public')
            : null;

        // Création de la postulation
        Postulation::create([
            'user_id' => $userId,
            'offer_id' => $offer_id,
            'cv' => $cvPath,
            'motivation_letter' => $motivationLetterPath,
            'status' => 'pending',
        ]);

        return redirect()->route('offers.index')->with('success', 'Postulation créée avec succès !');
    }

    // Affiche les détails d'une postulation
    public function show(Postulation $postulation)
    {
        return view('postulations.show', compact('postulation'));
    }

    // Affiche le formulaire d'édition d'une postulation
    public function edit(Postulation $postulation)
    {
        return view('postulations.edit', compact('postulation'));
    }

    // Met à jour une postulation existante
    public function update(Request $request, Postulation $postulation)
    {
        $request->validate([
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'motivation_letter' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        // Mettre à jour les fichiers si de nouveaux fichiers sont fournis
        if ($request->hasFile('cv')) {
            // Supprimer l'ancien fichier si nécessaire
            if ($postulation->cv) {
                Storage::delete('public/' . $postulation->cv);
            }
            $postulation->cv = $request->file('cv')->store('cvs', 'public');
        }

        if ($request->hasFile('motivation_letter')) {
            if ($postulation->motivation_letter) {
                Storage::delete('public/' . $postulation->motivation_letter);
            }
            $postulation->motivation_letter = $request->file('motivation_letter')->store('motivation_letters', 'public');
        }

        $postulation->status = $request->input('status');
        $postulation->save();

        return redirect()->route('postulations.index')->with('success', 'Postulation mise à jour avec succès.');
    }

    // Supprime une postulation
    public function destroy(Postulation $postulation)
    {
        // Supprimer les fichiers associés (CV, lettre de motivation)
        if ($postulation->cv) {
            Storage::delete('public/' . $postulation->cv);
        }
        if ($postulation->motivation_letter) {
            Storage::delete('public/' . $postulation->motivation_letter);
        }

        $postulation->delete();

        return redirect()->route('postulations.index')->with('success', 'Postulation supprimée avec succès.');
    }

    // Affiche toutes les postulations de l'utilisateur connecté
    public function index()
    {
        $userId = Auth::id();
        $postulations = Postulation::where('user_id', $userId)->with('offer')->get();

        return view('wishlists.show', compact('postulations'));
    }
    
}