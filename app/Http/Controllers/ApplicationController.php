<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Company;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function __construct() { $this->middleware('auth'); }

    public function index(Request $r) {
        $q = Application::with('company')
            ->where('user_id', auth()->id())
            ->when($r->status, fn($qq) => $qq->where('status', $r->status))
            ->latest();

        $applications = $q->paginate(10)->withQueryString();
        $companies = Company::where('user_id', auth()->id())->orderBy('name')->get();

        return view('applications.index', compact('applications','companies'));
    }