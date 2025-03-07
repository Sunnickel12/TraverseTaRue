<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index() {
        $offers = Offer::all();
        return view('offers.index', compact('offers'));
    }

    public function create() {
        return view('offers.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|unique:offers',
            'description' => 'required',
            'salary' => 'required|numeric',
            'location' => 'required',
            'company_id' => 'required|exists:companies,id',
        ]);

        Offer::create($request->all());
        return redirect()->route('offers.index');
    }

    public function show(Offer $offer) {
        return view('offers.show', compact('offer'));
    }

    public function edit(Offer $offer) {
        return view('offers.edit', compact('offer'));
    }

    public function update(Request $request, Offer $offer) {
        $request->validate([
            'title' => 'required|unique:offers,title,' . $offer->id,
            'description' => 'required',
            'salary' => 'required|numeric',
            'location' => 'required',
            'company_id' => 'required|exists:companies,id',
        ]);

        $offer->update($request->all());
        return redirect()->route('offers.index');
    }

    public function destroy(Offer $offer) {
        $offer->delete();
        return redirect()->route('offers.index');
    }
}
