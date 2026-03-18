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
        $cart =session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty.');
        }
        $subtotal=0;
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
        session()->forget('cart');
        return response()->json([
            'success'=> true,
            'redirect'=> route('order.orderHistory'),
        ]);
    }

        //basically for the orders to fetch orders from  user in the past
        public function orderHistory()
        { 
            $orders= Order::with('items.product')
                ->where('user_id', Auth::user()->user_id)
                ->latest('order_date')
                ->get();
            return view('orders.orderHistory', compact('orders'));
        }    
    }