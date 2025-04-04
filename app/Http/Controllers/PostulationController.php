<?php

namespace App\Http\Controllers;

use App\Models\Postulation;
use App\Models\Offer;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class PostulationController extends Controller
{
    // Show the form for creating a new postulation
    public function create($offer_id)
    {
        $authUser = Auth::user();

        // Role-based access control
        if (!$authUser->roles->contains('name', 'admin') && !$authUser->roles->contains('name', 'etudiant')) {
            abort(403, 'You are not authorized to postulate for this offer.');
        }

        $offer = Offer::findOrFail($offer_id); // Ensure the offer exists
        return view('postulations.create', compact('offer'));
    }

    // Store a new postulation in the database
    public function store(Request $request, $offer_id)
    {
        $request->validate([
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'motivation_letter' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $userId = Auth::id(); // ID of the logged-in user


        // Check if the user has already postulated for this offer
        $existingPostulation = Postulation::where('user_id', $userId)
            ->where('offer_id', $offer_id)
            ->first();

        if ($existingPostulation) {
            return redirect()->route('offers.show', $offer_id)
                ->with('error', 'Vous avez déjà postulé pour cette offre.');
        }

        // Save the CV
        $cvPath = $request->file('cv')->store('private/cvs');

        // Save the motivation letter if provided
        $motivationLetterPath = $request->file('motivation_letter')
            ? $request->file('motivation_letter')->store('private/motivation_letters')
            : null;


        // Create the postulation
        Postulation::create([
            'user_id' => $userId,
            'offer_id' => $offer_id,
            'cv' => $cvPath,
            'motivation_letter' => $motivationLetterPath,
            'status_id' => 4, // Assuming 1 is the ID for "pending" status
        ]);

        return redirect()->route('offers.index')->with('success', 'Votre postulation a été envoyée avec succès !');
    }

    // Display the details of a specific postulation
    public function show(Postulation $postulation)
    {
        $authUser = Auth::user();

        // Allow access for admins or the user who created the postulation
        if ($authUser->roles->contains('name', 'admin') || $authUser->id === $postulation->user_id) {
            $statuses = $authUser->roles->contains('name', 'admin') ? Status::all() : null; // Fetch statuses only for admins
            return view('postulations.show', compact('postulation', 'statuses'));
        }

        // Unauthorized access
        abort(403, 'You are not authorized to view this postulation.');
    }

    // Manage a specific postulation
    public function manage($id)
    {
        $postulation = Postulation::findOrFail($id); // Fetch the postulation by ID
        return view('postulations.manage', compact('postulation'));
    }

    // Show the form for editing a postulation
    public function edit(Postulation $postulation)
    {
        $statuses = Status::all(); // Fetch all statuses
        return view('postulations.edit', compact('postulation', 'statuses'));
    }

    // Update an existing postulation in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'status_id' => 'required|exists:statuses,id', // Ensure the status exists
        ]);

        // Find the postulation by ID
        $postulation = Postulation::findOrFail($id);

        // Update the status of the postulation
        $postulation->update([
            'status_id' => $request->status_id,
        ]);

        // Redirect to the previous URL or a fallback route
        return redirect($request->input('previous_url', route('users.dashboard')))
            ->with('success', 'Postulation status updated successfully.');
    }

    // Delete a postulation from the database
    public function destroy(Postulation $postulation)
    {
        // Authorization: Only admin or the user who created the postulation can delete it
        if (Gate::denies('delete-postulation', $postulation)) {
            abort(403, 'Unauthorized access.');
        }

        $postulation->delete(); // Soft delete
        return redirect()->route('users.dashboard')->with('success', 'Postulation deleted successfully.');
    }

    // Display all postulations of the logged-in user
    public function index()
    {
        $userId = Auth::id();
        $postulations = Postulation::where('user_id', $userId)->with('offer', 'status')->get();

        return view('postulations.index', compact('postulations'));
    }

    // Download a file (CV or motivation letter) associated with a postulation
    public function download($type, $id)
    {
        $postulation = Postulation::findOrFail($id);

        // Authorization: Only admin or the user who created the postulation can download files
        if (Auth::id() !== $postulation->user_id && !Auth::user()->roles->contains('name', 'admin')) {
            abort(403, 'Unauthorized access.');
        }

        // Determine the file path based on the type
        $filePath = $type === 'cv' ? $postulation->cv : $postulation->motivation_letter;

        // Check if the file exists
        if (!$filePath || !Storage::exists($filePath)) {
            abort(404, 'File not found.');
        }

        // Return the file as a download response
        return Storage::download($filePath);
    }
}
