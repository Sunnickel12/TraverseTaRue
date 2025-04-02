<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    // Affichage du formulaire
    public function show()
    {
        return view('contact.contact');
    }

    // Traitement du formulaire
    public function store(Request $request)
    {
        // Validation côté serveur
        $request->validate([
            'title' => 'required|max:50',
            'content' => 'required|max:255',
            'file' => 'nullable|file|mimes:jpg,png,pdf,docx,txt|max:10240',  // 10MB max
        ]);

        // Si un fichier est ajouté, on le stocke
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('documents', 'public');
        }

        // Création d'un nouveau contact avec statut par défaut (id=4)
        Contact::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'file' => $filePath,
            'status_id' => 4,  // "En attente" correspond à l'id 4
            'user_id' => Auth::id(),
        ]);

        // Redirection avec message de succès
        return redirect()->route('contact.show')->with('success', 'Votre message a été envoyé avec succès!');
    }
}
