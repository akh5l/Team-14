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
        $product = Product::with('category','reviews.user')->findOrFail($id);

        // game-specific details (not worth adding to DB at this stage, but possible improvement)

        if ($product->category_id == 2) {

            $gameDetails = [
                'God of War: Ragnarök'                    => [
                    'platform'   => 'PS5',
                    'developer'  => 'Santa Monica Studio',
                    'age_rating' => 'PEGI 18',
                ],
                'Red Dead Redemption 2'                   => [
                    'platform'   => 'PS4, PS5',
                    'developer'  => 'Rockstar Games',
                    'age_rating' => 'PEGI 18',
                ],
                'Cyberpunk 2077'                          => [
                    'platform'   => 'PS4, PS5',
                    'developer'  => 'CD Projekt Red',
                    'age_rating' => 'PEGI 18',
                ],
                'The Legend of Zelda: Breath of the Wild' => [
                    'platform'   => 'Nintendo Switch, Nintendo Switch 2',
                    'developer'  => 'Nintendo EPD',
                    'age_rating' => 'PEGI 12',
                ],
                'Elden Ring'                              => [
                    'platform'   => 'PS5',
                    'developer'  => 'FromSoftware',
                    'age_rating' => 'PEGI 16',
                ],
            ];

            // attach details if the product is in mapping
            if (array_key_exists($product->product_name, $gameDetails)) {
                foreach ($gameDetails[$product->product_name] as $key => $value) {
                    $product->$key = $value;
                }
            }

        }

        return view('products.show', compact('product'));
    }

    public function storeReview(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|min:5|max:500',
        ]);

        Review::create([
            'product_id' => $request->product_id,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back();
    }
}
