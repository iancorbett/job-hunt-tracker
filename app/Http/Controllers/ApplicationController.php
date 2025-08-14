<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ApplicationController extends Controller
{
    public function __construct() { $this->middleware('auth'); }

    public function index(Request $r) {
        $q = Application::with('company')
            ->where('user_id', Auth::id())
            ->when($r->status, fn($qq) => $qq->where('status', $r->status))
            ->latest();

        $applications = $q->paginate(10)->withQueryString();
        $companies = Company::where('user_id', Auth::id())->orderBy('name')->get();

        return view('applications.index', compact('applications','companies'));
    }

    public function create() {
        $companies = Company::where('user_id', Auth::id())->orderBy('name')->get();
        return view('applications.create', compact('companies'));
    }

    public function store(Request $r) {
        $data = $r->validate([
            'company_id' => ['required','exists:companies,id'],
            'role'       => ['required','string','max:255'],
            'status'     => ['required','in:Saved,Applied,Interview,Offer,Rejected'],
            'salary_min' => ['nullable','integer'],
            'salary_max' => ['nullable','integer','gte:salary_min'],
            'applied_at' => ['nullable','date'],
            'notes'      => ['nullable','string'],
        ]);

        
        Company::where('id', $data['company_id'])
            ->where('user_id', Auth::id())
            ->firstOrFail();

        Application::create($data + ['user_id' => Auth::id()]);
        return redirect()->route('applications.index')->with('ok','Application saved.');
    }

    public function destroy(Application $application) {
        abort_unless($application->user_id === Auth::id(), 403);
        $application->delete();
        return back()->with('ok','Application deleted.');
    }
}