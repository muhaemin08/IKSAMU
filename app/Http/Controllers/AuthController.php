<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        $settings = Setting::pluck('value', 'key')->all();
        return view('auth.login', compact('settings'));
    }

    public function login(Request $request)
    {
        $loginInput = $request->input('login') ?? $request->input('email') ?? $request->input('username');
        $password = $request->input('password');

        if (empty($loginInput) || empty($password)) {
            return back()->withErrors([
                'login' => 'Username/Email dan kata sandi wajib diisi.',
            ])->withInput();
        }

        $remember = $request->boolean('remember');

        // Cek login via username terlebih dahulu, lalu via email
        $isEmail = filter_var($loginInput, FILTER_VALIDATE_EMAIL);
        $primaryField = $isEmail ? 'email' : 'username';
        $secondaryField = $isEmail ? 'username' : 'email';

        if (Auth::attempt([$primaryField => $loginInput, 'password' => $password], $remember) ||
            Auth::attempt([$secondaryField => $loginInput, 'password' => $password], $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Selamat datang kembali, ' . Auth::user()->name);
        }

        return back()->withErrors([
            'login' => 'Username/Email atau kata sandi yang Anda masukkan salah.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar.');
    }
}
