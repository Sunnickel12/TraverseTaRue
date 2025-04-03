<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'title' => 'required|max:50',
            'content' => 'required|max:255',
            'file' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240', // Limite à 10MB
        ]);
    
        // Enregistrement du message de contact
        $contact = new Contact();
        $contact->title = $request->title;
        $contact->content = $request->content;
        $contact->status_id = 4; // Id du statut
        $contact->user_id = Auth::id(); // Id de l'utilisateur authentifié
        $contact->save();
    
        // Traitement du fichier téléchargé (un seul fichier)
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            
            // Générer un nom unique pour le fichier et le stocker dans le dossier 'contacts'
            $filePath = $file->store('contacts', 'public');
            
            // Enregistrement du chemin du fichier dans la base de données
            $contact->file = $filePath; // Stocke le chemin du fichier dans la colonne 'file'
            $contact->save(); // Met à jour le contact avec le chemin du fichier
        }
    
        // Redirection vers la page de succès avec un message
        return redirect()->route('contact.success')->with('successsend', 'Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.');
    }
}   