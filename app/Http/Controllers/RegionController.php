<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Country;
use Illuminate\Http\Request;

class RegionController extends Controller
{
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

    public function create()
    {
        $countries = Country::orderBy('name')->get();
        return view('admin.regions.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
        ]);

        Region::create($request->only('name', 'country_id'));

        return redirect()->route('regions.index')->with('success', 'Région ajoutée avec succès.');
    }

    public function edit(Region $region)
    {
        $countries = Country::orderBy('name')->get();
        return view('admin.regions.edit', compact('region', 'countries'));
    }

    public function update(Request $request, Region $region)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
        ]);

        $region->update($request->only('name', 'country_id'));

        return redirect()->route('regions.index')->with('success', 'Région mise à jour avec succès.');
    }

    public function destroy(Region $region)
    {
        $region->delete();
        return redirect()->route('regions.index')->with('success', 'Région supprimée avec succès.');
    }
}
