<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{

    public function index()
    {
        if (session()->has('buy_now')) {
            $items    = [session()->get('buy_now')];
            $isBuyNow = true;
        } else {
            $items    = session()->get('cart', []);
            $isBuyNow = false;
        }

        $subtotal = collect($items)->sum(fn($item) => $item['price'] * $item['quantity']);
        $delivery = request()->input('delivery', 0);
        $total    = $subtotal + $delivery;

        return view('checkout', compact('items', 'subtotal', 'delivery', 'total', 'isBuyNow'));
    }

}
