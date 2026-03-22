<?php
namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\StockLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function store(Request $request)
    {

        $request->validate([
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'postcode' => 'required|string|max:10',
        ]);

        if (session()->has('buy_now')) {
            $cart = [ session('buy_now') ];
        } else {
            $cart = session()->get('cart', []);
        }

        try {
            $this->createOrder($request, $cart);
        } catch (\Exception $e) {
            return redirect()->route('cart.index')->with('error', $e->getMessage());
        }

        if (!session()->has('buy_now')) {
            session()->forget('cart');
        }
        session()->forget('buy_now');

        return redirect()->route('orders.history')->with('success', true);
    }

    public function createOrder($request, $cart)
    {
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty.');
        }

        foreach ($cart as $item) {
            $product = Product::findOrFail($item['product_id']);
            if ($item['quantity'] > $product->stock) {
                throw new \Exception("Sorry, only {$product->stock} units of {$product->product_name} are available.");
            }
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'user_id' => Auth::user()->user_id,
            'order_date' => now(),
            'total_amount' => $subtotal,
            'order_status' => 'processing',
            'payment_method' => 'card',
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'city' => $request->city,
            'postcode' => $request->postcode,
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->order_id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'returned' => false,
            ]);
        }

        return $order;
    }

    public function process(Order $order)
    {
        foreach ($order->items as $item) {
            $item->product->decrement('stock', $item->quantity);
            StockLog::create([
                'product_id' => $item->product->product_id,
                'change' => -$item->quantity,
                'reason' => 'order',
            ]);
        }
        $order->update(['order_status' => 'delivered']);
        return back()->with('success');
    }

    public function returnItems(Request $request)
    {
        $itemIds = $request->input('item_ids', []);

        OrderItem::whereIn('order_item_id', $itemIds)
            ->whereHas('order', function ($query) {
                $query->where('user_id', Auth::user()->user_id)
                    ->where('order_status', 'delivered')
                    ->where('order_date', '>=', now()->subDays(30));
            })
            ->update(['returned' => true]);

        return back()->with('return_success', true);
    }

    //basically for the orders to fetch orders from  user in the past
    public function orderHistory()
    {
        $orders = Order::with('items.product')
            ->where('user_id', Auth::user()->user_id)
            ->latest('order_date')
            ->get();
        $ordersJson = $orders->map(function($order) {
            return [
                'id' => $order->order_id,
                'items' => $order->items->map(function($item) {
                    return [
                        'id' => $item->order_item_id,
                        'name' => $item->product ? $item->product->product_name : 'Product unavailable',
                        'quantity' => $item->quantity,
                        'returned' => $item->returned,
                    ];
                })
            ];
        });

        return view('orders.history', compact('orders', 'ordersJson'));
    }
}
