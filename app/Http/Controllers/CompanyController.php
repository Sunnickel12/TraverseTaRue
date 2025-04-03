<?php

namespace App\Http\Controllers;


use App\Models\Company;
use App\Models\City;
use App\Models\Sector;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Afficher la liste paginée des entreprises avec filtres optionnels.
     */
    public function index(Request $request)
    {
        // Récupération des paramètres de filtre
        $search = $request->input('search');
        $location = $request->input('location');
        $category = $request->input('category');

        // Récupérer les données pour les filtres (pour les villes et les secteurs)
        $locations = City::pluck('name', 'id');
        $sectors = Sector::pluck('name', 'id');

        // Appliquer les filtres sur les entreprises
        $companies = Company::query()
            ->when($search, fn($query) => $query->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%"))
            ->when($location, fn($query) => $query->whereHas('cities', fn($q) => $q->whereIn('cities.id', $location)))
            ->when($category, fn($query) => $query->whereHas('sectors', fn($q) => $q->whereIn('sectors.id', $category)))
            ->paginate(4);

        // Calculer la moyenne des évaluations pour chaque entreprise
        $companies->getCollection()->transform(function ($company) {
            // Si aucune évaluation n'est présente, la valeur par défaut sera 'N'
            $company->average_evaluation = $company->evaluations->avg('note') ?? 'N';
            return $company;
        });

        // Retourner la vue avec les données nécessaires
        return view('companies.index', compact('companies', 'locations', 'sectors'));
    }


    public function create()
    {
        $cities = City::all(); // Fetch all cities
        return view('companies.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:companies|max:255',
            'address' => 'required|max:255',
            'description' => 'required',
            'logo' => 'nullable|image|max:2048',
            'email' => 'required|email|unique:companies|max:255',
            'phone' => 'nullable|max:50',
            'city_id' => 'required|exists:cities,id',
        ], [
            'logo.max' => 'Le fichier logo est trop volumineux. La taille maximale autorisée est de 2 Mo.', // Message personnalisé
        ]);

        $company = Company::create($validated);

        // Attach the company to the selected city
        $company->cities()->attach($request->city_id);

        return redirect()->route('companies.index')->with('success', 'Entreprise créée avec succès.');
    }
    /**
     * Afficher les détails d'une entreprise spécifique.
     */
    public function show(Company $company)
    {
        // Load related evaluations
        $company->load('evaluations');

        // Calculate the average evaluation and ratings count
        $company->average_evaluation = $company->evaluations->avg('note') ?? 'N/A';
        $company->ratings_count = $company->evaluations->count();

        // Load offers count if needed
        $company->loadCount('offers');

        return view('companies.show', compact('company'));
    }

    /**
     * Afficher le formulaire d'édition d'une entreprise.
     */
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Mettre à jour une entreprise.
     */
    public function update(Request $request, Company $company)
    {
        $data = $this->validateCompany($request, $company->id);
        $data['logo'] = $this->handleLogoUpload($request, $company->logo);

        $company->update($data);

        return redirect()->route('companies.index')->with('success', 'Company updated successfully!');
    }

    /**
     * Supprimer une entreprise.
     */
    public function destroy(Company $company)
    {
        // Soft delete the company
        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Company soft deleted successfully!');
    }

    /**
     * Valider les données de l'entreprise.
     */
    private function validateCompany(Request $request, $companyId = null)
    {
        return $request->validate([
            'name' => "required|unique:companies,name,{$companyId},id|max:75",
            'address' => 'required|max:255',
            'description' => 'required',
            'logo' => 'nullable|image|max:2048',
            'email' => 'nullable|email|max:50',
            'phone' => 'nullable|string|max:50',
        ]);
    }

    /**
     * Gérer l'upload et la suppression du logo.
     */
    private function handleLogoUpload(Request $request, $oldLogo = null)
    {
        if ($request->hasFile('logo')) {
            $this->deleteLogo($oldLogo);
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/company'), $filename);
            return $filename;
        }
        return $oldLogo;
    }

    /**
     * Supprimer un ancien logo.
     */
    private function deleteLogo($logo)
    {
        if ($logo) {
            $logoPath = public_path('images/company/' . $logo);
            if (file_exists($logoPath)) {
                unlink($logoPath);
            }
        }
    }
}
