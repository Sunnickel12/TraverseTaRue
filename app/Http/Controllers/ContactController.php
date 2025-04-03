<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validation des données avec messages personnalisés
        $request->validate([
            'title'   => 'required|max:50',
            'content' => 'required|max:255',
            'file'    => 'nullable|mimes:pdf,doc,docx|max:10240',
        ], [
            'file.max' => 'Le fichier ne doit pas dépasser 10MB.',
            'file.mimes' => 'Seuls les fichiers PDF, DOC et DOCX sont autorisés.',
        ]);

        // Création et enregistrement de la demande de contact
        $contact = new Contact();
        $contact->title = $request->input('title');
        $contact->content = $request->input('content');
        $contact->status_id = 4;  // Statut "en attente"
        $contact->user_id = Auth::id();
        $contact->save();

        // Si un fichier a été envoyé, on l'enregistre
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('contacts', 'private');

            if ($filePath) {  // Vérification du stockage
                $contact->file = $filePath;
                $contact->save();
            }
        }

        return redirect()->route('contact.success')
            ->with('successsend', 'Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.');
    }

    public function success()
    {
        $contacts = Contact::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('contact.success', compact('contacts'));
    }

    public function adminContacts()
    {
        $contacts = Contact::latest()->get();
        return view('admin.support.index', compact('contacts'));
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'status' => 'required|exists:statuses,id',
        ]);

        $contact->status_id = $request->input('status');
        $contact->save();

        return redirect()->route('admin.support.show', $contact)
            ->with('success', 'Statut mis à jour avec succès.');
    }

    public function destroy(Contact $contact)
    {
        // Supprimer le fichier associé si présent
        if ($contact->file && Storage::disk('private')->exists($contact->file)) {
            Storage::disk('private')->delete($contact->file);
        }

        $contact->delete();

        return redirect()->route('admin.support.index')
            ->with('success', 'La demande de contact a été supprimée.');
    }

    public function show(Contact $contact)
    {
        $statuses = Status::all();
        return view('admin.support.show', compact('contact', 'statuses'));
    }

    public function download($contactId)
    {
        $contact = Contact::find($contactId);

        // Vérifie si la demande existe et si l'utilisateur a accès
        if (!$contact || (Auth::user()->cannot('view', $contact) && Auth::id() !== $contact->user_id)) {
            abort(403, 'Vous n\'êtes pas autorisé à accéder à ce fichier.');
        }

        // Vérifie l'existence du fichier
        if ($contact->file && Storage::disk('private')->exists($contact->file)) {
            return response()->download(storage_path('app/private/' . $contact->file));
        }

        return abort(404, 'Fichier non trouvé');
    }
}
