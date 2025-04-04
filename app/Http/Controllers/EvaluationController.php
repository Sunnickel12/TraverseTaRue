<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
    // Show the form for creating a new evaluation for a company
    public function create(Company $company)
    {
        return view('evaluations.create', compact('company'));
    }

    // Store a new evaluation in the database
    public function store(Request $request)
    {
        $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
            'company_id' => 'required|exists:companies,id',
        ]);

        Evaluation::create([
            'note' => $request->input('note'),
            'comment' => $request->input('comment'),
            'company_id' => $request->input('company_id'),
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('companies.show', $request->input('company_id'))
            ->with('success', 'Evaluation created successfully.');
    }

    // Display a list of evaluations for a specific company
    public function index(Company $company)
    {
        $evaluations = $company->evaluations()->latest()->paginate(10);

        $averageRating = $company->evaluations()->avg('note');

        return view('evaluations.index', compact('company', 'evaluations', 'averageRating'));
    }

    // Delete an evaluation from the database
    public function destroy(Evaluation $evaluation)
    {
        $evaluation->delete(); // Soft delete the evaluation

        return redirect()->back()->with('success', 'Evaluation deleted successfully.');
    }
}
