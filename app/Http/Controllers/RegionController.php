<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Country;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    // Display a list of regions with optional filters
    public function index(Request $request)
    {
        $query = Region::query()->with('country');

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        if ($countryId = $request->input('country_id')) {
            $query->where('country_id', $countryId);
        }

        $regions = $query->orderBy('name')->paginate(10);
        $countries = Country::orderBy('name')->get();

        return view('admin.regions.index', compact('regions', 'countries'));
    }

    // Show the form for creating a new region
    public function create()
    {
        $countries = Country::orderBy('name')->get();
        return view('admin.regions.create', compact('countries'));
    }

    // Store a new region in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
        ]);

        Region::create($request->only('name', 'country_id'));

        return redirect()->route('regions.index')->with('success', 'Région ajoutée avec succès.');
    }

    // Show the form for editing an existing region
    public function edit(Region $region)
    {
        $countries = Country::orderBy('name')->get();
        return view('admin.regions.edit', compact('region', 'countries'));
    }

    // Update an existing region in the database
    public function update(Request $request, Region $region)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
        ]);

        $region->update($request->only('name', 'country_id'));

        return redirect()->route('regions.index')->with('success', 'Région mise à jour avec succès.');
    }

    // Delete a region from the database
    public function destroy(Region $region)
    {
        $region->delete();
        return redirect()->route('regions.index')->with('success', 'Région supprimée avec succès.');
    }
}
