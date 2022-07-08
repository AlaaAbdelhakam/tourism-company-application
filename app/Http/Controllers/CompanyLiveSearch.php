<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyLiveSearch extends Controller
{
    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');
  
        // Search in the title and body columns from the posts table
        $companies = Company::query()
          ->where('company_name', 'LIKE', "%{$search}%")
          ->orWhere('company_code', 'LIKE', "%{$search}%")
          ->latest()->paginate(10);
        // Return the search view with the resluts compacted
        return view('dashboard.company.live_search', compact('companies'));
    }
}