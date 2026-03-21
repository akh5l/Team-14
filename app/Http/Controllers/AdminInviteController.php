<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\AdminInvite;

class AdminInviteController extends Controller
{
    public function index()
    {
        $invites = AdminInvite::latest()->get();
        return view('admin.dashboard', compact('invites'));
    }

    public function generate()
    {
        AdminInvite::create([
            'token' => Str::random(32),
            'expires_at' => now()->addHours(24),
        ]);

        return redirect('/admin')->with('success', 'Invite token generated.');
    }
}
