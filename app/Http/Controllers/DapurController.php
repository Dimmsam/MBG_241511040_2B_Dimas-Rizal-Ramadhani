<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DapurController extends Controller
{
    // Dashboard Dapur
    public function dashboard()
    {
        return view('dapur.dashboard');
    }
}
