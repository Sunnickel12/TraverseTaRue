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
        $search = $request->input('search');
        $location = $request->input('location');
        $category = $request->input('category');

        $locations = City::pluck('name', 'id');
        $sectors = Sector::pluck('name', 'id');

        $companies = Company::query()
            ->when($search, fn($query) => $query->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%"))
            ->when($location, fn($query) => $query->whereHas('cities', fn($q) => $q->whereIn('cities.id', $location)))
            ->when($category, fn($query) => $query->whereHas('sectors', fn($q) => $q->whereIn('sectors.id', $category)))
            ->paginate(4);

        return view('companies.index', compact('companies', 'locations', 'sectors'));
    }

    /**
     * Afficher le formulaire de création d'une entreprise.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Stocker une nouvelle entreprise.
     */
    public function store(Request $request)
    {
        $data = $this->validateCompany($request);
        $data['logo'] = $this->handleLogoUpload($request);

        Company::create($data);

        return redirect()->route('companies.index')->with('success', 'Company created successfully!');
    }

    /**
     * Afficher les détails d'une entreprise spécifique.
     */
    public function show(Company $company)
    {
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
        $this->deleteLogo($company->logo);
        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Company deleted successfully!');
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