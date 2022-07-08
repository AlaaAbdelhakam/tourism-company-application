<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarModel;

class CarmodelLiveSearch extends Controller
{
    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');
  
        // Search in the title and body columns from the posts table
        $carmodels = CarModel::query()
          ->where('car_model_name', 'LIKE', "%{$search}%")
        //   ->orWhere('email', 'LIKE', "%{$search}%")

          ->latest()->paginate(10);
        // Return the search view with the resluts compacted
        return view('dashboard.carmodels.live_search', compact('carmodels'));
    }
}