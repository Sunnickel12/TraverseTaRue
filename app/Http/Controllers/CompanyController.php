<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index() {
        $companies = Company::paginate(9);
        return view('companies.index', compact('companies'));
    }

    public function create() {
        return view('companies.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:companies',
            'address' => 'required',
            'description' => 'required',
            'logo' => 'required',
        ]);

        Company::create($request->all());
        return redirect()->route('companies.index');
    }

    public function show(Company $company) {
        return view('companies.show', compact('company'));
    }

    public function edit(Company $company) {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company) {
        $company->update($request->all());
        return redirect()->route('companies.index');
    }

    public function destroy(Company $company) {
        $company->delete();
        return redirect()->route('companies.index');
    }
}
