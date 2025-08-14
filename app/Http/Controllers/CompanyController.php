<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct() { $this->middleware('auth'); }

    public function index() {
        $companies = Company::where('user_id', auth()->id())->latest()->paginate(10);
        return view('companies.index', compact('companies'));
    }

    public function create() { return view('companies.create'); }

    public function store(Request $r) {
        $data = $r->validate([
            'name' => 'required|string|max:255',
            'website' => 'nullable|url',
            'location' => 'nullable|string|max:255',
        ]);
        Company::create($data + ['user_id' => auth()->id()]);
        return redirect()->route('companies.index')->with('ok','Company added.');
    }

    public function edit(Company $company) {
        abort_unless($company->user_id === auth()->id(), 403);
        return view('companies.edit', compact('company'));
    }

    public function update(Request $r, Company $company) {
        abort_unless($company->user_id === auth()->id(), 403);
        $data = $r->validate([
            'name' => 'required|string|max:255',
            'website' => 'nullable|url',
            'location' => 'nullable|string|max:255',
        ]);
        $company->update($data);
        return redirect()->route('companies.index')->with('ok','Company updated.');
    }
}
