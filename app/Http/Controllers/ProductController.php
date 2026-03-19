<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function products()
    {
        $query = Product::query();
        $currentCategory = null;

        if (request()->filled('category')) {
            $categoryID = request('category');
            $query->where('category_id', $categoryID);
            $currentCategory = Category::find($categoryID);
        }

        $products = $query->get();
        $categories = Category::all();

        return view('products.products', compact('products', 'currentCategory', 'categories'));
    }

    public function show($id)
    {
        $product = Product::with(['category','reviews.user'])->findOrFail($id);

        return view('products.show', compact('product'));
    }

    public function storeReview(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|min:5|max:500'
        ]);

        Review::create([
            'product_id' => $request->product_id,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        return back();
    }
}