<?php

namespace App\Http\Controllers;

use App\Models\Postulation;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostulationController extends Controller
{
    public function create($id_offer)
    {
        $offer = Offer::findOrFail($id_offer);
        return view('postulations.create', compact('offer'));
    }

    public function store(Request $request, $id_offer)
    {
        $request->validate([
            'cv' => 'required|file|mimes:pdf|max:2048',
            'motivation_letter' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Upload CV
        $cvPath = $request->file('cv')->store('cvs');

        // Upload Motivation Letter (if provided)
        $motivationLetterPath = $request->file('motivation_letter') 
            ? $request->file('motivation_letter')->store('motivation_letters') 
            : null;

        Postulation::create([
            'cv' => $cvPath,
            'motivation_letter' => $motivationLetterPath,
            'status' => 'Pending',
            'id_users' => Auth::id(),
            'id_offer' => $id_offer,
            'created_at' => now(),
        ]);

        return redirect()->route('offers.index')->with('success', 'Postulation submitted successfully!');
    }
}
