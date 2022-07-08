<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
class TripLiveSearch extends Controller
{
    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');
        // $trips->with('cities');

        // Search in the title and body columns from the posts table
        $trips = Trip::with('cities');
        $trips = $trips->whereHas('cities', function($q) use ($search) {
            $q->where('city_name', 'LIKE', "%{$search}%");})
        // ->query()
          ->orWhere('route_name', 'LIKE', "%{$search}%")
          ->orWhere('work_code', 'LIKE', "%{$search}%")
          ->orWhere('Date_of_trip', 'LIKE', "%{$search}%")
         
        ->get();
        // Return the search view with the resluts compacted
        return view('dashboard.trip.live_search', compact('trips'));
    }
}