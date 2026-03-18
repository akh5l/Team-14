<?php
namespace App\Http\Controllers;

use App\Models\Category;
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
        $query           = Product::query();
        $currentCategory = null;

        if (request()->filled('category')) {
            $categoryID = request('category');
            $query->where('category_id', $categoryID);

            $currentCategory = \App\Models\Category::find($categoryID);
        }

        $products = $query->get();
        $categories = Category::all();

        return view('products.products', compact('products', 'currentCategory', 'categories'));
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);

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
}
