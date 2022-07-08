<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Driver;
class LiveSearchdriver extends Controller
{
  
  public function search(Request $request){
      // Get the search value from the request
      $search = $request->input('search');

      // Search in the title and body columns from the table
      $drivers = Driver::query()
        ->where('driver_name', 'LIKE', "%{$search}%")
        ->orWhere('address', 'LIKE', "%{$search}%")
        ->latest()->paginate(10);
      // Return the search view with the resluts compacted
      return view('dashboard.drivers.live_search', compact('drivers'));
  }
}