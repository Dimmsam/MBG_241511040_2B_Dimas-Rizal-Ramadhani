<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permintaan;
use App\Models\BahanBaku;
use Illuminate\Support\Facades\Auth;

class DapurController extends Controller
{
    // Dashboard Dapur
    public function dashboard()
    {
        $userId = Auth::id();
        
        $totalPermintaan = Permintaan::where('pemohon_id', $userId)->count();
        $menunggu = Permintaan::where('pemohon_id', $userId)->where('status', 'menunggu')->count();
        $disetujui = Permintaan::where('pemohon_id', $userId)->where('status', 'disetujui')->count();
        $ditolak = Permintaan::where('pemohon_id', $userId)->where('status', 'ditolak')->count();

        return view('dapur.dashboard', compact('totalPermintaan', 'menunggu', 'disetujui', 'ditolak'));
    }

    // Lihat Status Permintaan (untuk dapur)
    public function index()
    {
        $userId = Auth::id();
        
        $permintaan = Permintaan::with(['details.bahan'])
                                ->where('pemohon_id', $userId)
                                ->orderBy('created_at', 'desc')
                                ->get();

        return view('dapur.permintaan.index', compact('permintaan'));
    }
}