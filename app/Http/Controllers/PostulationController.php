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
        'prenom' => 'required|string|max:255',
        'nom' => 'required|string|max:255',
        'mail' => 'required|email|max:255',
        'cv' => 'required|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:2048',
        'motivation' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:2048',
    ]);

    // Commenter la vérification d'authentification pour les tests
    $userId = 1; // Utilise un ID utilisateur fictif pour les tests

    // Sauvegarde du CV
    $cvPath = $request->file('cv')->store('cvs', 'public');
    
    // Sauvegarde de la lettre de motivation (si elle existe)
    $motivationLetterPath = $request->file('motivation_letter')
        ? $request->file('motivation_letter')->store('motivation_letters', 'public')
        : '';  // Utilisation de '' si aucune lettre de motivation n'est fournie

    // Création de la postulation
    Postulation::create([
        'id_users' => $userId,
        'id_offers' => $id_offers,
        'cv' => $cvPath,
        'motivation_letter' => $motivationLetterPath, // Lettre de motivation (ou chaîne vide)
        'status' => 'Pending',
    ]);

    return redirect()->route('offres')->with('success', 'Postulation successful !');
    }
    /*p

    public function update(Request $request, $id_postulation)
    {
        $request->validate([
            'cv' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:2048',
            'motivation_letter' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:2048',
        ]);

        $postulation = Postulation::findOrFail($id_postulation);

        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
            $postulation->cv = $cvPath;
        }

        if ($request->hasFile('motivation_letter')) {
            $motivationPath = $request->file('motivation_letter')->store('motivation_letters', 'public');
            $postulation->motivation_letter = $motivationPath;
        }

        $postulation->save();

        return redirect()->route('w_candidatures')->with('success', 'Candidature mise à jour avec succès.');
    }*/




    // Affiche la liste des candidatures de l'utilisateur (wishlist)
    public function wishlist()
    {
        // Récupérer toutes les postulations de l'étudiant connecté
        $postulations = Postulation::where('id_users', 1)->with('offer')->get(); // Utilisation de l'ID fictif pour les tests

        return view('partials.w_candidatures', compact('postulations'));
    }
    
}
/*public function wishlist()
{
    if (Auth::check()) {
        $userId = Auth::id(); // Récupère l'ID de l'utilisateur connecté
        
        // Récupérer toutes les postulations de l'utilisateur connecté
        $postulations = Postulation::where('id_users', $userId)->with('offer')->get();

        return view('partials.w_candidatures', compact('postulations'));
    } else {
        // Si l'utilisateur n'est pas connecté, redirige vers la page de connexion
        return redirect()->route('login');
    }
}*/
