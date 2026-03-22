<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 'customer')->get();
        return view('admin.dashboard', compact('customers'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->user_id . ',user_id',
            'phone' => 'required|string|max:20',
        ]);

        $user->update($request->only('first_name', 'last_name', 'email', 'phone'));

        return back()->with('success');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success');
    }
}
