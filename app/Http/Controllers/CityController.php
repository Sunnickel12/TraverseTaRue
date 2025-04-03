<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Departement;
use App\Models\Region;
use App\Models\Country;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Affiche la liste des villes avec filtres et recherche.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = City::with('departement.region.country');

        // Filtrage par nom de ville
        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        // Filtrage par département
        if ($departementId = $request->input('departement_id')) {
            $query->where('departement_id', $departementId);
        }

        // Filtrage par région
        if ($regionId = $request->input('region_id')) {
            $query->whereHas('departement.region', function ($q) use ($regionId) {
                $q->where('id', $regionId);
            });
        }

        // Filtrage par pays
        if ($countryId = $request->input('country_id')) {
            $query->whereHas('departement.region.country', function ($q) use ($countryId) {
                $q->where('id', $countryId);
            });
        }

        $cities = $query->paginate(10);

        // Chargement des données pour les filtres
        $departements = Departement::orderBy('name')->get();
        $regions = Region::orderBy('name')->get();
        $countries = Country::orderBy('name')->get();

        return view('admin.cities.index', compact('cities', 'departements', 'regions', 'countries'));
    }

    /**
     * Affiche le formulaire de création d'une nouvelle ville.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $departements = Departement::with('region.country')->get();
        return view('admin.cities.create', compact('departements'));
    }

    /**
     * Enregistre une nouvelle ville dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'departement_id' => 'required|exists:departements,id',
        ]);

        City::create($request->only('name', 'departement_id'));

        return redirect()->route('cities.index')->with('success', 'Ville créée avec succès.');
    }

    /**
     * Affiche le formulaire pour éditer une ville existante.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\View\View
     */
    public function edit(City $city)
    {
        $departements = Departement::with('region.country')->get();
        return view('admin.cities.edit', compact('city', 'departements'));
    }

    /**
     * Met à jour les informations d'une ville existante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, City $city)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'departement_id' => 'required|exists:departements,id',
        ]);

        $city->update($request->only('name', 'departement_id'));

        return redirect()->route('cities.index')->with('success', 'Ville mise à jour avec succès.');
    }

    /**
     * Supprime une ville de la base de données.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(City $city)
    {
        $city->delete();
        return redirect()->route('cities.index')->with('success', 'Ville supprimée avec succès.');
    }
}
