<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    // Display a paginated list of companies
    public function index()
    {
        $companies = Company::paginate(9);
        return view('companies.index', compact('companies'));
    }

    // Show the form for creating a new company
    public function create()
    {
        return view('companies.create');
    }

    // Store a new company in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:companies',
            'address' => 'required',
            'description' => 'required',
            'logo' => 'required|image|max:2048',
        ]);

        // Handle logo upload
        $logoPath = $request->file('logo')->store('logos', 'public');

        // Create the company
        Company::create([
            'name' => $request->name,
            'address' => $request->address,
            'description' => $request->description,
            'location' => $request->location ?? '',
            'contact_email' => $request->contact_email ?? '',
            'logo' => $logoPath,
        ]);

        return redirect()->route('companies.index')->with('success', 'Company created successfully!');
    }

    // Display a specific company's details
    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    // Show the form to edit an existing company
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    // Update a company's information
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|unique:companies,name,' . $company->id,
            'address' => 'required',
            'description' => 'required',
            'logo' => 'nullable|image|max:2048',
        ]);

        // Check if a new logo is uploaded
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $company->logo = $logoPath;
        }

        $company->update([
            'name' => $request->name,
            'address' => $request->address,
            'description' => $request->description,
            'location' => $request->location,
            'contact_email' => $request->contact_email,
        ]);

        return redirect()->route('companies.index')->with('success', 'Company updated successfully!');
    }

    // Delete a company
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully!');
    }
}
