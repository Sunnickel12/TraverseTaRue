<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class ContactController extends Controller
{
    // Store a new contact request in the database
    public function store(Request $request)
    {
        // Validate the data with custom messages
        $request->validate([
            'title'   => 'required|max:50',
            'content' => 'required|max:255',
            'file'    => 'nullable|mimes:pdf,doc,docx|max:10240',
        ], [
            'file.max' => 'Le fichier ne doit pas dépasser 10MB.',
            'file.mimes' => 'Seuls les fichiers PDF, DOC et DOCX sont autorisés.',
        ]);

        // Create and save the contact request
        $contact = new Contact();
        $contact->title = $request->input('title');
        $contact->content = $request->input('content');
        $contact->status_id = 4;  // Status "pending"
        $contact->user_id = Auth::id();
        $contact->save();

        // If a file is uploaded, save it
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('contacts', 'private');

            if ($filePath) {  // Verify storage
                $contact->file = $filePath;
                $contact->save();
            }
        }

        return redirect()->route('contact.success')
            ->with('successsend', 'Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.');
    }

    // Display the success page for contact requests
    public function success()
    {
        $contacts = Contact::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('contact.success', compact('contacts'));
    }

    // Display all contact requests for the admin
    public function adminContacts()
    {
        $contacts = Contact::latest()->get();
        return view('admin.support.index', compact('contacts'));
    }

    // Update the status of a contact request
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

    // Delete a contact request from the database
    public function destroy(Contact $contact)
    {
        // Delete the associated file if present
        if ($contact->file && Storage::disk('private')->exists($contact->file)) {
            Storage::disk('private')->delete($contact->file);
        }

        $contact->delete();

        return redirect()->route('admin.support.index')
            ->with('success', 'La demande de contact a été supprimée.');
    }

    // Display the details of a specific contact request
    public function show(Contact $contact)
    {
        $statuses = Status::all();
        return view('admin.support.show', compact('contact', 'statuses'));
    }

    // Download a file associated with a contact request
    public function download($contactId)
    {
        $contact = Contact::find($contactId);

        // Verify if the contact request exists and if the user has access
        if (!$contact || (Gate::denies('view', $contact) && Auth::id() !== $contact->user_id && !Auth::user()->roles->contains('name', 'admin'))) {
            abort(403, 'Vous n\'êtes pas autorisé à accéder à ce fichier.');
        }

        // Verify the existence of the file
        if ($contact->file && Storage::disk('private')->exists($contact->file)) {
            return response()->download(storage_path('app/private/' . $contact->file));
        }

        return abort(404, 'Fichier non trouvé');
    }
}
