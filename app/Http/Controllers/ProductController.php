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
        if (request()->filled('search')) {
            $search = request('search');
            $query->where('product_name', 'like', "%{$search}%")
            ->orWhere('description', 'like', "%{$search}%");
        }

        $products = $query->get();

        return view('products.products', compact('products'));
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('products.show', compact('product'));
    }
}
