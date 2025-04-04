<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    // Display a list of countries with optional search
    public function index(Request $request)
    {
        $query = Country::query();

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        $countries = $query->orderBy('name', 'asc')->paginate(10);

        return view('admin.countries.index', compact('countries'));
    }

    // Show the form for creating a new country
    public function create()
    {
        return view('admin.countries.create');
    }

    // Store a new country in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:countries,name',
        ]);

        Country::create($request->only('name'));

        return redirect()->route('countries.index')->with('success', 'Pays ajouté avec succès.');
    }

    // Show the form for editing an existing country
    public function edit(Country $country)
    {
        return view('admin.countries.edit', compact('country'));
    }

    // Update an existing country in the database
    public function update(Request $request, Country $country)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:countries,name,' . $country->id,
        ]);

        $country->update($request->only('name'));

        return redirect()->route('countries.index')->with('success', 'Pays mis à jour avec succès.');
    }

    // Delete a country from the database
    public function destroy(Country $country)
    {
        $country->delete();

        return redirect()->route('countries.index')->with('success', 'Pays supprimé avec succès.');
    }
}
