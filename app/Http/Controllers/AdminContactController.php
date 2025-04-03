<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin'); // Assurer que seuls les admins peuvent accéder
    }

    // Afficher toutes les demandes de contact
    public function index()
    {

        $contacts = Contact::with('user', 'status')->get();  // Récupère tous les contacts avec leurs utilisateurs et statuts
        return view('admin.contacts.index', compact('contacts'));  // Passer les contacts à la vue

    }

    // Afficher le détail d'une demande de contact
    public function show($id)
    {
        $contact = Contact::with('user', 'status')->findOrFail($id);
        return view('admin.contacts.show', compact('contact'));
    }

    // Répondre à une demande de contact (mettre à jour le statut)
    public function updateStatus(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->status_id = $request->status_id; // Mettre à jour le statut de la demande
        $contact->save();

        return redirect()->route('admin.contacts.index')->with('success', 'Statut mis à jour avec succès.');
    }
}
