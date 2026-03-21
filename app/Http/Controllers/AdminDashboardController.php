<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\AdminInvite;
use App\Models\Order;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $invites = AdminInvite::latest()->get();
        $orders = Order::with('items.product', 'user')->latest('order_date')->get();
        return view('admin.dashboard', compact('invites', 'orders'));
    }

    public function generateInvite()
    {
        AdminInvite::create([
            'token' => Str::random(32),
            'expires_at' => now()->addHours(24),
        ]);

        return redirect('/admin')->with('success', 'Invite token generated.');
    }
}
