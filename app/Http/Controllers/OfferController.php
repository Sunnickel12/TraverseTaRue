<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

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

        return view('offers.index', compact('offers'));
    }

    // Show the form to create a new offer
    public function create()
    {
        return view('offers.create');
    }

    // Store a new offer in the database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'contenu' => 'required',
            'salary' => 'required|numeric|min:0',
            'level' => 'required|max:50',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'duration' => 'required|max:50',
            'company_id' => 'required|exists:companies,id',
        ]);

        Offer::create($request->all());

        return redirect()->route('offers.index')->with('success', 'Offer created successfully!');
    }

    // Display a specific offer's details
    public function show(Offer $offer)
    {
        return view('offers.show', compact('offer'));
    }

    // Show the form to edit an existing offer
    public function edit(Offer $offer)
    {
        return view('offers.edit', compact('offer'));
    }

    // Update an offer's information
    public function update(Request $request, Offer $offer)
    {
        $request->validate([
            'title' => 'required|max:255',
            'contenu' => 'required',
            'salary' => 'required|numeric|min:0',
            'level' => 'required|max:50',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'duration' => 'required|max:50',
            'company_id' => 'required|exists:companies,id',
        ]);

        $offer->update($request->all());

        return redirect()->route('offers.index')->with('success', 'Offer updated successfully!');
    }

    // Delete an offer
    public function destroy(Offer $offer)
    {
        $offer->delete();

        return redirect()->route('offers.index')->with('success', 'Offer deleted successfully!');
    }
}
?>