<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Region;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    // Display a list of departments with optional filters
    public function index(Request $request)
    {
        $query = Departement::query()->with('region');

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        if ($regionId = $request->input('region_id')) {
            $query->where('region_id', $regionId);
        }

        $departements = $query->orderBy('name')->paginate(10);
        $regions = Region::orderBy('name')->get();

        return view('admin.departements.index', compact('departements', 'regions'));
    }

    // Show the form for creating a new department
    public function create()
    {
        $regions = Region::orderBy('name')->get();
        return view('admin.departements.create', compact('regions'));
    }

    // Store a new department in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'region_id' => 'required|exists:regions,id',
        ]);

        Departement::create($request->only('name', 'region_id'));

        return redirect()->route('departements.index')->with('success', 'Département ajouté avec succès.');
    }

    // Show the form for editing an existing department
    public function edit(Departement $departement)
    {
        $regions = Region::orderBy('name')->get();
        return view('admin.departements.edit', compact('departement', 'regions'));
    }

    // Update an existing department in the database
    public function update(Request $request, Departement $departement)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'region_id' => 'required|exists:regions,id',
        ]);

        $departement->update($request->only('name', 'region_id'));

        return redirect()->route('departements.index')->with('success', 'Département mis à jour avec succès.');
    }

    // Delete a department from the database
    public function destroy(Departement $departement)
    {
        $departement->delete();
        return redirect()->route('departements.index')->with('success', 'Département supprimé avec succès.');
    }
}
