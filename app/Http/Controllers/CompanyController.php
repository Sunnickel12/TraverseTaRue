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
    // with an optional search filter
    public function index(Request $request)
    {
        $search = $request->input('search');

        $companies = Company::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        })->paginate(9);

        return view('companies.index', compact('companies'));
    }

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

        $data = $request->all();

        // Handle the logo upload
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename); // Save in public/images
            $data['logo'] = $filename; // Save the filename in the database
        }

        Company::create($data);

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
            'name' => 'required|unique:companies,name,' . $company->id . ',id|max:75',
            'address' => 'required|max:255',
            'description' => 'required',
            'logo' => 'nullable|image|max:2048',
            'email' => 'nullable|email|max:50',
            'phone' => 'nullable|string|max:50',
        ]);

        $data = $request->all();

        // Handle the logo upload
        if ($request->hasFile('logo')) {
            // Delete the old logo if it exists
            if ($company->logo) {
                $oldLogoPath = public_path('images/' . $company->logo);
                if (file_exists($oldLogoPath)) {
                    unlink($oldLogoPath);
                }
            }

            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename); // Save in public/images
            $data['logo'] = $filename; // Save the filename in the database
        }

        $company->update($data);

        return redirect()->route('companies.index')->with('success', 'Company updated successfully!');
    }


    // Delete a company
    public function destroy(Company $company)
    {
        // Delete the logo file if it exists
        if ($company->logo) {
            $logoPath = public_path('images/' . $company->logo);
            if (file_exists($logoPath)) {
                unlink($logoPath);
            }
        }

        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Company deleted successfully!');
    }
}
