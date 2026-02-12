<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /* ================= LOGIN ================= */

    public function login()
    {
        return view('auth.login');
    }

    public function loginStore(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {

            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ])->withInput();
    }

    /* ================= LOGOUT ================= */

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /* ================= REGISTER ================= */

    public function register()
    {
        return view('auth.register');
    }

    public function registerStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ], [
            'email.unique' => 'Email sudah terdaftar',
            'password.confirmed' => 'Konfirmasi password tidak cocok'
        ]);

        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login');
    }
}
