<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Region;
use Illuminate\Support\Facades\Storage;

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
            'name' => 'required|unique:companies|max:75',
            'address' => 'required|max:255',
            'description' => 'required',
            'logo' => 'nullable|image|max:2048',
            'email' => 'nullable|email|max:50',
            'phone' => 'nullable|string|max:50',
        ]);

        $logoPath = $request->file('logo')->storeAs('images', $request->file('logo')->getClientOriginalName(), 'public');

        Company::create([
            'name' => $request->name,
            'address' => $request->address,
            'description' => $request->description,
            'logo' => $logoPath,
            'email' => $request->email,
            'phone' => $request->phone,
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
            'name' => 'required|unique:companies,name,' . $company->id_company . ',id_company|max:75',
            'address' => 'required|max:255',
            'description' => 'required',
            'logo' => 'nullable|image|max:2048',
            'email' => 'nullable|email|max:50',
            'phone' => 'nullable|string|max:50',
        ]);

        if ($request->hasFile('logo')) {
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }
            $company->logo = $request->file('logo')->store('images', 'public');
        }        

        $company->update([
            'name' => $request->name,
            'address' => $request->address,
            'description' => $request->description,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect()->route('companies.index')->with('success', 'Company updated successfully!');
    }

    
    // Delete a company
    public function destroy(Company $company)
    {
        if ($company->logo) {
            Storage::disk('public')->delete($company->logo);
        }
        
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully!');
    }
}