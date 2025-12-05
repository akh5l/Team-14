<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'product_id'   => $product->id,
                'product_name' => $product->product_name,
                'price'        => $product->price,
                'quantity'     => 1,
            ];
        }

        session()->put('cart', $cart);
        return back()->with('success', 'Added to cart!');
    }

    public function update(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = max(1, (int) $request->quantity);
            session()->put('cart', $cart);
        }
        return back()->with('success', 'Cart updated!');
    }

    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session()->put('cart', $cart);
        }
        return back()->with('success', 'Item removed');
    }
}
