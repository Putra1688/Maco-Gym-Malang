<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginInput = trim($request->input('phone'));
        $password = $request->input('password');

        // 1. Coba login dengan Nomor Telepon / WhatsApp
        $authenticated = Auth::attempt([
            'phone' => $loginInput,
            'password' => $password,
        ]);

        // 2. Jika gagal, coba login dengan ID Kartu Member (misal MC-001)
        if (! $authenticated) {
            $member = Member::where('card_id', $loginInput)->first();
            if ($member && $member->user_id) {
                $authenticated = Auth::attempt([
                    'id' => $member->user_id,
                    'password' => $password,
                ]);
            }
        }

        if ($authenticated) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->isAdmin() || $user->isStaff()) {
                return redirect()->intended(route('admin.dashboard'));
            }

            if ($user->isMember()) {
                return redirect()->intended(route('member.dashboard'));
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'phone' => 'Nomor WhatsApp / ID Kartu atau password tidak sesuai.',
        ])->onlyInput('phone');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function showResetPassword(): View
    {
        return view('auth.passwords.reset');
    }
}
