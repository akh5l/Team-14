<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $featured = Product::inRandomOrder()->take(3)->get();
        $categories = Category::all();

        return view('home', compact('featured', 'categories'));
    }
}
