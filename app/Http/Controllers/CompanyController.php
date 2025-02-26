<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index(Request $request) {
        
        $companies = Company::orderBy('name', 'ASC')
            ->paginate(10)->appends(request()->query());

        return view('pages.companies.index')->with([
            'companies' => $companies
        ]);
    }
}
