<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\City;
use App\Models\Sector;
use App\Models\Skill;

class OfferController extends Controller
{
    // Display a paginated list of offers with an optional search filter
    public function index(Request $request)
    {
        // Fetch filter inputs
        $skills = Skill::pluck('name', 'id'); // Fetch all skills
        $cities = City::pluck('name', 'id'); // Fetch all cities
        $sectors = Sector::pluck('name', 'id'); // Fetch all sectors
        $companies = Company::pluck('name', 'id'); // Fetch all companies

        // Query offers with filters
        $offers = Offer::query()
            ->when($request->input('search'), function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                    ->orWhere('contenu', 'like', "%{$search}%");
            })
            ->when($request->input('skills'), function ($query, $skills) {
                return $query->whereHas('skills', function ($q) use ($skills) {
                    $q->whereIn('id', $skills); // Filter by skills
                });
            })
            ->when($request->input('city'), function ($query, $city) {
                return $query->whereHas('city', function ($q) use ($city) {
                    $q->whereIn('id', $city); // Filter by city
                });
            })
            ->when($request->input('sector'), function ($query, $sector) {
                return $query->whereHas('sectors', function ($q) use ($sector) {
                    $q->whereIn('id', $sector); // Filter by sector
                });
            })
            ->when($request->input('company'), function ($query, $company) {
                return $query->whereHas('company', function ($q) use ($company) {
                    $q->whereIn('id', $company); // Filter by company
                });
            })
            ->paginate(9);

        return view('offers.index', compact('offers', 'skills', 'cities', 'sectors', 'companies'));
    }

    // Show the form to create a new offer
    public function create()
    {
        $sectors = Sector::all(); // Fetch all sectors
        $companies = Company::all(); // Fetch all companies
        $cities = City::all(); // Fetch all cities

        return view('offers.create', compact('sectors', 'companies', 'cities'));
    }

    // Store a new offer in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'contenu' => 'required|string',
            'salary' => 'required|numeric|min:0',
            'level' => 'required|string|max:50',
            'start_date' => 'required|date',
            'end_date' => [
                'required',
                'date',
                'after:start_date',
                function ($attribute, $value, $fail) use ($request) {
                    $startDate = \Carbon\Carbon::parse($request->start_date);
                    $endDate = \Carbon\Carbon::parse($value);
                    $diffInMonths = $startDate->diffInMonths($endDate);

                    if ($diffInMonths > 6) {
                        $fail('The end date must be no more than 6 months after the start date.');
                    }
                },
            ],
            'duration' => 'required|string|max:50',
            'city_id' => 'required|exists:cities,id',
            'company_id' => 'required|exists:companies,id',
            'sectors' => 'required|array', // Validate sectors as an array
            'sectors.*' => 'exists:sectors,id', // Ensure each sector exists
        ]);

        $offer = Offer::create($validated);

        // Sync sectors
        $offer->sectors()->sync($validated['sectors']);

        return redirect()->route('offers.index')->with('success', 'Offer created successfully.');
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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'contenu' => 'required|string',
            'salary' => 'required|numeric|min:0',
            'level' => 'required|string|max:50',
            'start_date' => 'required|date',
            'end_date' => [
                'required',
                'date',
                'after:start_date',
                function ($attribute, $value, $fail) use ($request) {
                    $startDate = \Carbon\Carbon::parse($request->start_date);
                    $endDate = \Carbon\Carbon::parse($value);
                    $diffInMonths = $startDate->diffInMonths($endDate);

                    if ($diffInMonths > 6) {
                        $fail('The end date must be no more than 6 months after the start date.');
                    }
                },
            ],
            'duration' => 'required|string|max:50',
            'city_id' => 'required|exists:cities,id',
            'company_id' => 'required|exists:companies,id',
            'sectors' => 'required|array', // Validate sectors as an array
            'sectors.*' => 'exists:sectors,id', // Ensure each sector exists
        ]);

        $offer->update($validated);

        // Sync sectors
        $offer->sectors()->sync($validated['sectors']);

        return redirect()->route('offers.index')->with('success', 'Offer updated successfully.');
    }

    // Delete an offer
    public function destroy(Offer $offer)
    {
        $offer->delete();

        return redirect()->route('offers.index')->with('success', 'Offer deleted successfully!');
    }
}
