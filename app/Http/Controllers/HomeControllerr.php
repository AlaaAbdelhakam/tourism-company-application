<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeControllerr extends Controller
{
    public function index(){
        return view('dashboard.welcome');
    }
}