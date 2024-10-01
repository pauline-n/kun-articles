<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $age = 10;
        return view('home')->with('age', $age);
    }
}
