<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
class CityLiveSearch extends Controller
{
    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');
  
        // Search in the title and body columns from the posts table
        $cities = City::query()
          ->where('city_name', 'LIKE', "%{$search}%")
    
          ->latest()->paginate(10);
        // Return the search view with the resluts compacted
        return view('dashboard.city.live_search', compact('cities'));
    }
}