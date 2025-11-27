<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featured = Product::inRandomOrder()->take(3)->get();
        return view('home', compact('featured'));
    }
}
