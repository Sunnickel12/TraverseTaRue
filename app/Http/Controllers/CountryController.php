<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $query = Country::query();

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        $countries = $query->orderBy('name', 'asc')->paginate(10);

        return view('admin.countries.index', compact('countries'));
    }

    public function create()
    {
        return view('admin.countries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:countries,name',
        ]);

        Country::create($request->only('name'));

        return redirect()->route('countries.index')->with('success', 'Pays ajouté avec succès.');
    }

    public function edit(Country $country)
    {
        return view('admin.countries.edit', compact('country'));
    }

    public function update(Request $request, Country $country)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:countries,name,' . $country->id,
        ]);

        $country->update($request->only('name'));

        return redirect()->route('countries.index')->with('success', 'Pays mis à jour avec succès.');
    }

    public function destroy(Country $country)
    {
        $country->delete();

        return redirect()->route('countries.index')->with('success', 'Pays supprimé avec succès.');
    }
}
