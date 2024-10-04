<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        // $age = 10;
        echo 'my only hope';
        return view('home');
    }
}
