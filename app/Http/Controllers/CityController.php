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
     * Displays the list of cities with filters and search.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = City::with('departement.region.country');

        // Filtering by city name
        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        // Filtering by department
        if ($departementId = $request->input('departement_id')) {
            $query->where('departement_id', $departementId);
        }

        // Filtering by region
        if ($regionId = $request->input('region_id')) {
            $query->whereHas('departement.region', function ($q) use ($regionId) {
                $q->where('id', $regionId);
            });
        }

        // Filtering by country
        if ($countryId = $request->input('country_id')) {
            $query->whereHas('departement.region.country', function ($q) use ($countryId) {
                $q->where('id', $countryId);
            });
        }

        $cities = $query->paginate(10);

        // Loading data for filters
        $departements = Departement::orderBy('name')->get();
        $regions = Region::orderBy('name')->get();
        $countries = Country::orderBy('name')->get();

        return view('admin.cities.index', compact('cities', 'departements', 'regions', 'countries'));
    }

    /**
     * Displays the form to create a new city.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $departements = Departement::with('region.country')->get();
        return view('admin.cities.create', compact('departements'));
    }

    /**
     * Saves a new city to the database.
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

        return redirect()->route('cities.index')->with('success', 'City successfully created.');
    }

    /**
     * Displays the form to edit an existing city.
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
     * Updates the information of an existing city.
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

        return redirect()->route('cities.index')->with('success', 'City successfully updated.');
    }

    /**
     * Deletes a city from the database.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(City $city)
    {
        $city->delete();
        return redirect()->route('cities.index')->with('success', 'City successfully deleted.');
    }
}
