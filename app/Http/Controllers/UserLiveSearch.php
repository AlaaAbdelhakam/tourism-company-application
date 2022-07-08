<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;
class UserLiveSearch extends Controller
{
    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');
  
        // Search in the title and body columns from the posts table
        $users = User::query()
          ->where('name', 'LIKE', "%{$search}%")
          ->orWhere('email', 'LIKE', "%{$search}%")
          ->latest()->paginate(10);
        // Return the search view with the resluts compacted
        return view('dashboard.users.live_search', compact('users'));
    }
}