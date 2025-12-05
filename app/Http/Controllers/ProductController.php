<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index() // categories
    {
        $products = Product::with('category')->paginate(9);
        return view('products.index', compact('products'));
    }

    public function products() // all products
    {
        $query = Product::query();
        $currentCategory = null;

        if (request()->filled('search')) {
            $search = request('search');
            $query->where('product_name', 'like', "%{$search}%")
            ->orWhere('description', 'like', "%{$search}%");
        }

        if (request()->filled('category')) {
        $categoryID = request('category');
        $query->where('category_id', $categoryID);

        $currentCategory = \App\Models\Category::find($categoryID);
        }

        $products = $query->get();
        

        return view('products.products', compact('products', 'currentCategory'));
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('products.show', compact('product'));
    }
}
