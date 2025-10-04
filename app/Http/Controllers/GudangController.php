<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanBaku;
use Carbon\Carbon;

class GudangController extends Controller
{
    // Dashboard Gudang
    public function dashboard()
    {
        return view('gudang.dashboard');
    }

    // Form tambah bahan baku
    public function create()
    {
        return view('gudang.bahan.create');
    }

    // Proses simpan bahan baku
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:120',
            'kategori' => 'required|max:60',
            'jumlah' => 'required|integer|min:0',
            'satuan' => 'required|max:20',
            'tanggal_masuk' => 'required|date',
            'tanggal_kadaluarsa' => 'required|date|after:tanggal_masuk',
        ], [
            'nama.required' => 'Nama bahan wajib diisi',
            'kategori.required' => 'Kategori wajib diisi',
            'jumlah.required' => 'Jumlah wajib diisi',
            'jumlah.min' => 'Jumlah tidak boleh negatif',
            'satuan.required' => 'Satuan wajib diisi',
            'tanggal_masuk.required' => 'Tanggal masuk wajib diisi',
            'tanggal_kadaluarsa.required' => 'Tanggal kadaluarsa wajib diisi',
            'tanggal_kadaluarsa.after' => 'Tanggal kadaluarsa harus setelah tanggal masuk',
        ]);

        BahanBaku::create([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan,
            'tanggal_masuk' => $request->tanggal_masuk,
            'tanggal_kadaluarsa' => $request->tanggal_kadaluarsa,
            'status' => 'tersedia',
            'created_at' => Carbon::now()
        ]);

        return redirect()->route('gudang.dashboard');
    }
}
