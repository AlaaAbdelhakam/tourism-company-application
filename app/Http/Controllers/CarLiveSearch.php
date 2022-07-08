<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarLiveSearch extends Controller
{
    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');
  
        // Search in the title and body columns from the table
        $cars = Car::query()
          ->where('capacity', 'LIKE', "%{$search}%")
          ->orWhere('plate_no', 'LIKE', "%{$search}%")
          ->orWhere('car_code', 'LIKE', "%{$search}%")
          ->orWhere('expected_amount_of_solar_for_100Km', 'LIKE', "%{$search}%")

          ->latest()->paginate(10);
        // Return the search view with the resluts compacted
        return view('dashboard.cars.live_search', compact('cars'));
    }
}