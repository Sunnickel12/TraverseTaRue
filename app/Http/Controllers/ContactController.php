<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Status; // Importation du modèle Status
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'title'   => 'required|max:50',
            'content' => 'required|max:255',
            'file'    => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240',
        ]);

        // Création et enregistrement de la demande de contact
        $contact = new Contact();
        $contact->title = $request->input('title');
        $contact->content = $request->input('content');
        $contact->status_id = 4;  // Id du statut (par exemple, 'en attente')
        $contact->user_id = Auth::id();  // Associe l'utilisateur authentifié à la demande
        $contact->save();

        // Si un fichier a été envoyé, on l'enregistre
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('contacts', 'private');
            $contact->file = $filePath;
            $contact->save();  // Mise à jour avec le fichier
        }

        // Redirection vers la page de succès
        return redirect()->route('contact.success')
            ->with('successsend', 'Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.');
    }

    public function success()
    {
        // Récupérer les contacts de l'utilisateur authentifié
        $contacts = Contact::where('user_id', Auth::id())
            ->latest()
            ->get();

        // Retourner la vue de succès avec les contacts
        return view('contact.success', compact('contacts'));
    }

    public function adminContacts()
    {
        // Récupérer tous les contacts (ou les contacts non traités, selon le besoin)
        $contacts = Contact::latest()->get();

        // Retourner la vue de l'index avec les contacts
        return view('admin.support.index', compact('contacts'));
    }

    public function update(Request $request, Contact $contact)
    {
        // Validation des données avec les statuts disponibles dans la base de données
        $request->validate([
            'status' => 'required|exists:statuses,id', // Vérification que le statut existe dans la base de données
        ]);

        // Mise à jour du statut
        $contact->status_id = $request->input('status');
        $contact->save();

        return redirect()->route('admin.contacts.show', $contact)
            ->with('success', 'Le statut a été mis à jour.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('admin.support.index')
            ->with('success', 'La demande de contact a été supprimée.');
    }

    public function show(Contact $contact)
    {
        // Récupérer tous les statuts disponibles pour le formulaire de mise à jour
        $statuses = Status::all();

        // Retourner la vue show avec les détails de la demande de contact et les statuts
        return view('admin.support.show', compact('contact', 'statuses'));
    }

    public function download($contactId)
    {
        // Récupère la demande de contact avec l'ID donné
        $contact = Contact::find($contactId);

        // Vérifie si la demande existe et si l'utilisateur est autorisé à télécharger ce fichier
        if (!$contact || $contact->user_id !== Auth::id()) {
            // Si l'utilisateur n'est pas autorisé, retourne une erreur 403
            abort(403, 'Vous n\'êtes pas autorisé à accéder à ce fichier.');
        }

        // Vérifie si le fichier existe
        if (Storage::disk('private')->exists($contact->file)) {
            // Retourne le fichier pour le téléchargement
            return response()->download(storage_path('app/private/' . $contact->file));
        }

        // Si le fichier n'existe pas, retourne une erreur 404
        return abort(404, 'Fichier non trouvé');
    }
}
