<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Company;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\Region;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::with(['company', 'city'])->paginate(9);
        return view('offers.index', compact('offers'));
    }

    public function show(Offer $offer)
    {
        return view('offers.show', compact('offer'));
    }

    public function create()
    {
        $companies = Company::all();
        $cities = City::all();
        return view('offers.create', compact('companies', 'cities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tittle' => 'required|max:255',
            'contenu' => 'required',
            'salary' => 'required|numeric',
            'id_city' => 'required|exists:cities,id_city',
            'id_companie' => 'required|exists:companies,id_companie',
        ]);

        Offer::create($request->all());
        return redirect()->route('offers.index')->with('success', 'Offer created successfully.');
    }

    public function edit(Offer $offer)
    {
        $companies = Company::all();
        $cities = City::all();
        return view('offers.edit', compact('offer', 'companies', 'cities'));
    }

    public function update(Request $request, Offer $offer)
    {
        $request->validate([
            'tittle' => 'required|max:255',
            'contenu' => 'required',
            'salary' => 'required|numeric',
            'id_city' => 'required|exists:cities,id_city',
            'id_companie' => 'required|exists:companies,id_companie',
        ]);

        $offer->update($request->all());
        return redirect()->route('offers.index')->with('success', 'Offer updated successfully.');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $offers = Offer::with('city')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('title', 'like', "%$keyword%");
            })
            ->paginate(10);

        return view('offers.search', compact('offers'));
    }
    public function destroy(Offer $offer)
    {
        $offer->delete();
        return redirect()->route('offers.index')->with('success', 'Offer deleted successfully.');
    }
}
