<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use App\Models\AdminInvite;
use Illuminate\Support\Str;

class AdminAuthController extends Controller
{
    public function showRegister()
    {
        return view('admin.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            // 'password' => ['required', 'confirmed', Password::defaults()],
            'invite_token' => 'required',

            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => 'required',
        ]);

        $invite = AdminInvite::where('token', $request->invite_token)->first();

        if (!$invite || !$invite->isValid()) {
            return back()->withErrors([
                'invite_token' => 'Invalid or expired invite token.'
            ]);
        }

        $invite->update(['used' => true]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make(Str::random(32)), // temporary random password

            'first_name' => $request->first_name,
            'last_name' => $request->last_name,

            'phone' => $request->phone,

            'role' => 'admin',
            'force_password_change' => true,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('admin.password.update')->with('success', 'Admin created');
    }
}