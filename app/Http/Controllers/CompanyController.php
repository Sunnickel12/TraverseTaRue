<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\City; // Pour les villes
use App\Models\Sector; // Ajout du modèle Sector pour récupérer les secteurs
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    // Afficher la liste paginée des entreprises avec filtres optionnels
    public function index(Request $request)
    {
        $search = $request->input('search');
        $location = $request->input('location');
        $category = $request->input('category');

        // Fetch companies with evaluations and calculate the average evaluation score
        $companies = Company::with('evaluations')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->when($location, function ($query, $location) {
                $query->whereHas('city', function ($q) use ($location) {
                    $q->where('id', $location);
                });
            })
            ->when($category, function ($query, $category) {
                $query->whereHas('sectors', function ($q) use ($category) {
                    $q->where('id', $category);
                });
            })
            ->whereNull('deleted_at') // Exclude soft-deleted companies
            ->paginate(4);

        // Calculate the average evaluation for each company
        $companies->getCollection()->transform(function ($company) {
            $company->average_evaluation = $company->evaluations->avg('note') ?? 'N';
            return $company;
        });

        return view('companies.index', [
            'companies' => $companies,
            'locations' => City::pluck('name', 'id'),
            'sectors' => Sector::pluck('name', 'id'),
        ]);
    }

    // Méthode pour créer une nouvelle entreprise
    public function create()
    {
        return view('companies.create');
    }

    // Stocker une nouvelle entreprise
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:companies|max:75',
            'address' => 'required|max:255',
            'description' => 'required',
            'logo' => 'nullable|image|max:2048',
            'email' => 'nullable|email|max:50',
            'phone' => 'nullable|string|max:50',
        ]);

        $data = $request->all();

        // Handle the logo upload
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename); // Save in public/images
            $data['logo'] = $filename; // Save the filename in the database
        }

        Company::create($data);

        return redirect()->route('companies.index')->with('success', 'Company created successfully!');
    }

    // Afficher les détails d'une entreprise spécifique
    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    // Formulaire d'édition d'une entreprise
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    // Mettre à jour une entreprise
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|unique:companies,name,' . $company->id . ',id|max:75',
            'address' => 'required|max:255',
            'description' => 'required',
            'logo' => 'nullable|image|max:2048',
            'email' => 'nullable|email|max:50',
            'phone' => 'nullable|string|max:50',
        ]);

        $data = $request->all();

        // Handle the logo upload
        if ($request->hasFile('logo')) {
            // Supprimer l'ancien logo si il existe
            if ($company->logo) {
                $oldLogoPath = public_path('images/' . $company->logo);
                if (file_exists($oldLogoPath)) {
                    unlink($oldLogoPath);
                }
            }

            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename); // Save in public/images
            $data['logo'] = $filename; // Save the filename in the database
        }

        $company->update($data);

        return redirect()->route('companies.index')->with('success', 'Company updated successfully!');
    }

    // Supprimer une entreprise
    public function destroy(Company $company)
    {
        // Soft delete the company
        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Company soft deleted successfully!');
    }
}
