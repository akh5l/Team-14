<?php
namespace App\Http\Controllers;

use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function add(Product $product)
    {
        $cart = session()->get('cart', []);

        // dd($product->product_id, $product->product_name);

        if (isset($cart[$product->product_id])) {
            $cart[$product->product_id]['quantity']++;
        } else {
            $cart[$product->product_id] = [
                'product_id'   => $product->product_id,
                'product_name' => $product->product_name,
                'image_url' => $product->image_url,
                'price'        => $product->price,
                'quantity'     => 1,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function buyNow(Product $product)
    {

        $cart = [];

        $cart[$product->product_id] = [
            'product_id'   => $product->product_id,
            'product_name' => $product->product_name,
            'image_url' => $product->image_url,
            'price'        => $product->price,
            'quantity'     => 1,
        ];

        session()->put('cart', $cart);

        return redirect()->route('checkout');
    }

    public function remove($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }
        return back()->with('success', 'Item removed');
    }
}
