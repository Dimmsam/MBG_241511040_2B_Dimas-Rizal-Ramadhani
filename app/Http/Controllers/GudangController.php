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
        $totalBahan = BahanBaku::count();
        $bahanTersedia = BahanBaku::where('jumlah', '>', 0)->count();
        $bahanSegera = BahanBaku::whereRaw('DATEDIFF(tanggal_kadaluarsa, CURDATE()) <= 3')
                                ->whereRaw('DATEDIFF(tanggal_kadaluarsa, CURDATE()) >= 0')
                                ->where('jumlah', '>', 0)
                                ->count();
        $bahanKadaluarsa = BahanBaku::whereRaw('CURDATE() >= tanggal_kadaluarsa')->count();
        
        return view('gudang.dashboard', compact('totalBahan', 'bahanTersedia', 'bahanSegera', 'bahanKadaluarsa'));
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

        return redirect()->route('gudang.bahan.index')->with('success', 'Bahan baku berhasil ditambahkan');
    }

    // Menampilkan daftar bahan baku
    public function index()
    {
        $bahanBaku = BahanBaku::orderBy('created_at', 'asc')->get();
        
        // Update status otomatis untuk setiap bahan
        foreach ($bahanBaku as $bahan) {
            $statusOtomatis = $bahan->status_otomatis;
            if ($bahan->status !== $statusOtomatis) {
                $bahan->status = $statusOtomatis;
                $bahan->save();
            }
        }

        return view('gudang.bahan.index', compact('bahanBaku'));
    }

    // Form edit stok bahan baku
    public function edit($id)
    {
        $bahan = BahanBaku::findOrFail($id);
        return view('gudang.bahan.edit', compact('bahan'));
    }

    // Proses update stok bahan baku
    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:0',
        ], [
            'jumlah.required' => 'Jumlah wajib diisi',
            'jumlah.min' => 'Jumlah tidak boleh negatif',
        ]);

        $bahan = BahanBaku::findOrFail($id);
        $bahan->jumlah = $request->jumlah;
        
        // Update status berdasarkan jumlah baru
        $bahan->status = $bahan->status_otomatis;
        $bahan->save();

        return redirect()->route('gudang.bahan.index')->with('success', 'Stok bahan baku berhasil diupdate');
    }

    // Hapus bahan baku (hanya yang kadaluarsa)
    public function destroy($id)
    {
        $bahan = BahanBaku::findOrFail($id);
        
        // Cek apakah status kadaluarsa
        if ($bahan->status_otomatis !== 'kadaluarsa') {
            return redirect()->route('gudang.bahan.index')
                           ->with('error', 'Hanya bahan baku dengan status kadaluarsa yang dapat dihapus');
        }

        $bahan->delete();

        return redirect()->route('gudang.bahan.index')->with('success', 'Bahan baku berhasil dihapus');
    }
}
