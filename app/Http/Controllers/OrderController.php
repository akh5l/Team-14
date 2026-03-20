<?php
namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function store(Request $request)
    {

        if (session()->has('buy_now')) {
            $cart = [ session('buy_now') ];
        } else {
            $cart = session()->get('cart', []);
        }

        try {
            $this->createOrder(Auth::user()->user_id, $cart);
        } catch (\Exception $e) {
            return redirect()->route('cart.index')->with('error', $e->getMessage());
        }

        if (!session()->has('buy_now')) {
            session()->forget('cart');
        }
        session()->forget('buy_now');

        return redirect()->route('orders.history')->with('success', true);
    }

    public function createOrder($userId, $cart)
    {
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty.');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'user_id' => Auth::user()->user_id,
            'order_date' => now(),
            'total_amount' => $subtotal,
            'order_status' => 'pending',
            'payment_method' => 'card',
            'tracking_number' => null,
            'notes' => null,
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->order_id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        return $order;
    }

    //basically for the orders to fetch orders from  user in the past
    public function orderHistory()
    {
        $orders = Order::with('items.product')
            ->where('user_id', Auth::user()->user_id)
            ->latest('order_date')
            ->get();
        return view('orders.history', compact('orders'));
    }
}
