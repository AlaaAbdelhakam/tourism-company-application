<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Codriver;

class CodriverLiveSearch extends Controller
{
    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');
  
        // Search in the title and body columns from the posts table
        $codrivers = Codriver::query()
          ->where('co_driver_name', 'LIKE', "%{$search}%")
          ->orWhere('Date_of_birth', 'LIKE', "%{$search}%")
          ->orWhere('id', 'LIKE', "%{$search}%")
          ->latest()->paginate(10);
        // Return the search view with the resluts compacted
        return view('dashboard.codriver.live_search', compact('codrivers'));
    }
}