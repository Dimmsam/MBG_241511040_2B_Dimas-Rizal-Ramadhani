<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GudangController extends Controller
{
    // Dashboard Gudang
    public function dashboard()
    {
        return view('gudang.dashboard');
    }
}
