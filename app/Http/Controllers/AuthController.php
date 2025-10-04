<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole();
        }
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Cek apakah user ada dan password cocok (MD5)
        if ($user && md5($request->password) === $user->password) {
            Auth::login($user);
            
            $request->session()->regenerate();
            
            return $this->redirectBasedOnRole();
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
            'password'=> 'Email atau password salah'
        ])->withInput();
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')->with('success', 'Berhasil logout');
    }

    // Helper untuk redirect berdasarkan role
    private function redirectBasedOnRole()
    {
        if (Auth::user()->role === 'gudang') {
            return redirect()->route('gudang.dashboard');
        } else {
            return redirect()->route('dapur.dashboard');
        }
    }
}
