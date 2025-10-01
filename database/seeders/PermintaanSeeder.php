<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermintaanSeeder extends Seeder
{
    public function run()
    {
        // Data Permintaan
        $permintaan = [
            [
                'id' => 1,
                'pemohon_id' => 6,
                'tgl_masak' => '2025-09-30',
                'menu_makan' => 'Nasi ayam goreng + sayur bayam',
                'jumlah_porsi' => 200,
                'status' => 'disetujui',
                'created_at' => '2025-09-28 10:00:00',
            ],
            [
                'id' => 2,
                'pemohon_id' => 7,
                'tgl_masak' => '2025-09-30',
                'menu_makan' => 'Tempe goreng + sayur wortel',
                'jumlah_porsi' => 150,
                'status' => 'disetujui',
                'created_at' => '2025-09-28 10:05:00',
            ],
            [
                'id' => 3,
                'pemohon_id' => 8,
                'tgl_masak' => '2025-10-01',
                'menu_makan' => 'Nasi + ayam rebus + bayam bening',
                'jumlah_porsi' => 180,
                'status' => 'menunggu',
                'created_at' => '2025-09-29 10:10:00',
            ],
            [
                'id' => 4,
                'pemohon_id' => 9,
                'tgl_masak' => '2025-10-01',
                'menu_makan' => 'Kentang balado + telur rebus',
                'jumlah_porsi' => 120,
                'status' => 'disetujui',
                'created_at' => '2025-09-29 10:15:00',
            ],
            [
                'id' => 5,
                'pemohon_id' => 10,
                'tgl_masak' => '2025-10-02',
                'menu_makan' => 'Nasi tempe orek + sayur sop',
                'jumlah_porsi' => 200,
                'status' => 'menunggu',
                'created_at' => '2025-09-29 10:20:00',
            ],
            [
                'id' => 6,
                'pemohon_id' => 6,
                'tgl_masak' => '2025-10-02',
                'menu_makan' => 'Ayam goreng tepung + wortel kukus',
                'jumlah_porsi' => 220,
                'status' => 'ditolak',
                'created_at' => '2025-09-29 10:25:00',
            ],
            [
                'id' => 7,
                'pemohon_id' => 7,
                'tgl_masak' => '2025-10-03',
                'menu_makan' => 'Nasi telur dadar + bayam bening',
                'jumlah_porsi' => 180,
                'status' => 'menunggu',
                'created_at' => '2025-09-30 10:30:00',
            ],
            [
                'id' => 8,
                'pemohon_id' => 8,
                'tgl_masak' => '2025-10-03',
                'menu_makan' => 'Kentang rebus + ayam suwir',
                'jumlah_porsi' => 160,
                'status' => 'menunggu',
                'created_at' => '2025-09-30 10:35:00',
            ],
            [
                'id' => 9,
                'pemohon_id' => 9,
                'tgl_masak' => '2025-10-04',
                'menu_makan' => 'Nasi + tempe goreng + sayur bening',
                'jumlah_porsi' => 190,
                'status' => 'menunggu',
                'created_at' => '2025-09-30 10:40:00',
            ],
            [
                'id' => 10,
                'pemohon_id' => 10,
                'tgl_masak' => '2025-10-04',
                'menu_makan' => 'Sup ayam + susu fortifikasi',
                'jumlah_porsi' => 210,
                'status' => 'menunggu',
                'created_at' => '2025-09-30 10:45:00',
            ],
        ];

        foreach ($permintaan as $p) {
            DB::table('permintaan')->insert($p);
        }
    }
}