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

}
