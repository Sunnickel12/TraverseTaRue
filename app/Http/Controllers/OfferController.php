<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\City;

class OfferController extends Controller
{
    // Display a paginated list of offers with an optional search filter
    public function index(Request $request)
    {
        $search = $request->input('search');

        $offers = Offer::with('company')->when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%")
                ->orWhere('contenu', 'like', "%{$search}%");
        })->paginate(9);

        // Count the total number of offers
        $totalOffers = Offer::count();

        return view('offers.index', compact('offers', 'totalOffers', 'search'));
    }

    // Show the form to create a new offer
    public function create()
    {
        $companies = Company::all(); // Fetch all companies
        $cities = City::all(); // Fetch all cities
        return view('offers.create', compact('companies', 'cities'));
    }

    // Store a new offer in the database
    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'contenu' => 'required|string', // Changed 'text' to 'string'
            'salary' => 'required|numeric|min:0',
            'duration' => 'required|string|max:50',
            'level' => 'required|string|max:50',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'company_id' => 'required|exists:companies,id',
            'city_id' => 'required|exists:cities,id', // Validate city_id
        ]);

        // Create a new offer with validated data
        Offer::create($validated);

        // Redirect back with a success message
        return redirect()->route('offers.index')->with('success', 'Offre créée avec succès.');
    }

    // Display a specific offer's details
    public function show(Offer $offer)
    {
        $offer->load('city'); // Eager load the city relationship
        return view('offers.show', compact('offer'));
    }

    // Show the form to edit an existing offer
    public function edit(Offer $offer)
    {
        $companies = Company::all(); // Fetch all companies for the dropdown
        $cities = City::all(); // Fetch all cities for the dropdown
        return view('offers.edit', compact('offer', 'companies', 'cities'));
    }

    // Update an offer's information
    public function update(Request $request, Offer $offer)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'contenu' => 'required|string',
            'salary' => 'required|numeric|min:0',
            'duration' => 'required|string|max:50',
            'level' => 'required|string|max:50',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'company_id' => 'required|exists:companies,id',
            'city_id' => 'required|exists:cities,id', // Validate city_id
        ]);

        // Update the offer with validated data
        $offer->update($validated);

        // Redirect back with a success message
        return redirect()->route('offers.index')->with('success', 'Offre mise à jour avec succès.');
    }

    // Delete an offer
    public function destroy(Offer $offer)
    {
        $offer->delete();

        return redirect()->route('offers.index')->with('success', 'Offer deleted successfully!');
    }
}
