<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // Redirect berdasarkan role
            if ($user->role === 'gudang') {
                return redirect()->route('dashboard.gudang')->with('success', 'Login berhasil! Selamat datang ' . $user->name);
            } elseif ($user->role === 'dapur') {
                return redirect()->route('dashboard.dapur')->with('success', 'Login berhasil! Selamat datang ' . $user->name);
            }
            
            return redirect()->intended('/')->with('success', 'Login berhasil!');
        }

        return redirect()->back()
            ->withErrors(['email' => 'Email atau password salah.'])
            ->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login')->with('success', 'Logout berhasil!');
    }

    public function dashboardGudang()
    {
        if (Auth::user()->role !== 'gudang') {
            return redirect('/login')->withErrors(['error' => 'Akses ditolak!']);
        }
        
        return view('dashboard.gudang');
    }

    public function dashboardDapur()
    {
        if (Auth::user()->role !== 'dapur') {
            return redirect('/login')->withErrors(['error' => 'Akses ditolak!']);
        }
        
        return view('dashboard.dapur');
    }
}