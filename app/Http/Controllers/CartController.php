<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        session()->forget('buy_now');
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function add(Product $product)
    {
        $cart = session()->get('cart', []);

        $currentQty = isset($cart[$product->product_id]) ? $cart[$product->product_id]['quantity'] : 0;

        if ($currentQty >= $product->stock) {
            return redirect()->back()->with('error', 'Sorry, no more stock available for this product.');
        }


        if (isset($cart[$product->product_id])) {
            $cart[$product->product_id]['quantity']++;
        } else {
            $cart[$product->product_id] = [
                'product_id'   => $product->product_id,
                'product_name' => $product->product_name,
                'image_url'    => $product->image_url,
                'price'        => $product->price,
                'quantity'     => 1,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function buyNow(Product $product)
    {
        $buyNowItem = [
            'product_id'   => $product->product_id,
            'product_name' => $product->product_name,
            'image_url'    => $product->image_url,
            'price'        => $product->price,
            'quantity'     => 1,
        ];

        session()->put('buy_now', $buyNowItem);

        return redirect()->route('checkout.index');
    }

    public function update(Request $request, $productId)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            $quantity = (int) $request->quantity;
            $product = Product::findOrFail($productId);
            if ($quantity <= 0) {
                unset($cart[$productId]);
            } else {
                $cart[$productId]['quantity'] = min($quantity, $product->stock);
            }
            session()->put('cart', $cart);
        }
        return back()->with('success', 'Cart Updated!');
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
