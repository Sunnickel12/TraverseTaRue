<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\City;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    /**
     * Display a paginated list of companies with optional filters.
     */
    public function index(Request $request)
    {
        $query = Company::query();

        // Join with evaluations to calculate the average evaluation dynamically
        $query->withCount(['evaluations as average_evaluation' => function ($query) {
            $query->select(DB::raw('coalesce(avg(note), 0)'));
        }]);

        // Filter by location (city) using the situates table
        if ($request->has('location') && !empty($request->location)) {
            $query->whereHas('cities', function ($q) use ($request) {
                $q->whereIn('id', $request->location);
            });
        }

        // Filter by category (sector)
        if ($request->has('category') && !empty($request->category)) {
            $query->whereHas('sectors', function ($q) use ($request) {
                $q->whereIn('id', $request->category);
            });
        }

        // Filter by average evaluation
        if ($request->has('average_evaluation') && !empty($request->average_evaluation)) {
            $query->having('average_evaluation', '>=', $request->average_evaluation);
        }

        // Search by name or description
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $companies = $query->with('sectors')->paginate(4)->appends($request->query());

        // Pass filters to the view
        $locations = City::pluck('name', 'id');
        $sectors = Sector::pluck('name', 'id');

        return view('companies.index', compact('companies', 'locations', 'sectors'));
    }

    /**
     * Show the form to create a new company.
     */
    public function create()
    {
        $cities = City::all(); // Fetch all cities
        $sectors = Sector::all(); // Fetch all sectors
        return view('companies.create', compact('cities', 'sectors'));
    }

    /**
     * Store a new company in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:companies|max:255',
            'address' => 'required|max:255',
            'description' => 'required',
            'logo' => 'nullable|image|max:2048',
            'email' => 'required|email|unique:companies|max:255',
            'phone' => 'nullable|max:50',
            'city_id' => 'required|exists:cities,id',
            'sectors' => 'required|array', // Validate sectors as an array
            'sectors.*' => 'exists:sectors,id', // Validate each sector ID
        ], [
            'logo.max' => 'The logo file is too large. The maximum allowed size is 2 MB.', // Custom message
        ]);

        // Handle the logo upload
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/company'), $filename);
            $validated['logo'] = $filename; // Add the logo filename to the validated data
        }

        $company = Company::create($validated);

        // Attach the company to the selected city
        $company->cities()->attach($request->city_id);

        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }

    /**
     * Display the details of a specific company.
     */
    public function show(Company $company)
    {
        // Load related evaluations
        $company->load('evaluations');

        // Calculate the average evaluation and ratings count
        $company->average_evaluation = $company->evaluations->avg('note') ?? 'N/A';
        $company->ratings_count = $company->evaluations->count();

        // Load offers count if needed
        $company->loadCount('offers');

        return view('companies.show', compact('company'));
    }

    /**
     * Show the form to edit a company.
     */
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update a company's information.
     */
    public function update(Request $request, Company $company)
    {
        $data = $this->validateCompany($request, $company->id);
        $data['logo'] = $this->handleLogoUpload($request, $company->logo);

        $company->update($data);

        return redirect()->route('companies.index')->with('success', 'Company updated successfully!');
    }

    /**
     * Soft delete a company.
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Company soft deleted successfully!');
    }

    /**
     * Validate company data.
     */
    private function validateCompany(Request $request, $companyId = null)
    {
        return $request->validate([
            'name' => "required|unique:companies,name,{$companyId},id|max:75",
            'address' => 'required|max:255',
            'description' => 'required',
            'logo' => 'nullable|image|max:2048',
            'email' => 'nullable|email|max:50',
            'phone' => 'nullable|string|max:50',
        ]);
    }

    /**
     * Handle logo upload and deletion.
     */
    private function handleLogoUpload(Request $request, $oldLogo = null)
    {
        if ($request->hasFile('logo')) {
            $this->deleteLogo($oldLogo);
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/company'), $filename);
            return $filename;
        }
        return $oldLogo;
    }

    /**
     * Delete an old logo file.
     */
    private function deleteLogo($logo)
    {
        if ($logo) {
            $logoPath = public_path('images/company/' . $logo);
            if (file_exists($logoPath)) {
                unlink($logoPath);
            }
        }
    }
}
