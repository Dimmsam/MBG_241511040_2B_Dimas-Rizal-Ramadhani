<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermintaanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permintaanDetail = [
            [
                'id' => 1,
                'permintaan_id' => 1,
                'bahan_id' => 1,
                'jumlah_diminta' => 50,
            ],
            [
                'id' => 2,
                'permintaan_id' => 1,
                'bahan_id' => 3,
                'jumlah_diminta' => 40,
            ],
            [
                'id' => 3,
                'permintaan_id' => 1,
                'bahan_id' => 6,
                'jumlah_diminta' => 50,
            ],
            
            [
                'id' => 4,
                'permintaan_id' => 2,
                'bahan_id' => 1,
                'jumlah_diminta' => 40,
            ],
            [
                'id' => 5,
                'permintaan_id' => 2,
                'bahan_id' => 5,
                'jumlah_diminta' => 30,
            ],
            [
                'id' => 6,
                'permintaan_id' => 2,
                'bahan_id' => 7,
                'jumlah_diminta' => 20,
            ],
            
            [
                'id' => 7,
                'permintaan_id' => 3,
                'bahan_id' => 1,
                'jumlah_diminta' => 45,
            ],
            [
                'id' => 8,
                'permintaan_id' => 3,
                'bahan_id' => 3,
                'jumlah_diminta' => 30,
            ],
            [
                'id' => 9,
                'permintaan_id' => 3,
                'bahan_id' => 6,
                'jumlah_diminta' => 40,
            ],
            
            [
                'id' => 10,
                'permintaan_id' => 4,
                'bahan_id' => 1,
                'jumlah_diminta' => 30,
            ],
            [
                'id' => 11,
                'permintaan_id' => 4,
                'bahan_id' => 8,
                'jumlah_diminta' => 20,
            ],
            [
                'id' => 12,
                'permintaan_id' => 4,
                'bahan_id' => 2,
                'jumlah_diminta' => 60,
            ],
            
            [
                'id' => 13,
                'permintaan_id' => 5,
                'bahan_id' => 1,
                'jumlah_diminta' => 60,
            ],
            [
                'id' => 14,
                'permintaan_id' => 5,
                'bahan_id' => 5,
                'jumlah_diminta' => 30,
            ],
            [
                'id' => 15,
                'permintaan_id' => 5,
                'bahan_id' => 7,
                'jumlah_diminta' => 20,
            ],
            
            [
                'id' => 16,
                'permintaan_id' => 6,
                'bahan_id' => 1,
                'jumlah_diminta' => 50,
            ],
            [
                'id' => 17,
                'permintaan_id' => 6,
                'bahan_id' => 3,
                'jumlah_diminta' => 50,
            ],
            
            [
                'id' => 18,
                'permintaan_id' => 7,
                'bahan_id' => 1, 
                'jumlah_diminta' => 40,
            ],
            [
                'id' => 19,
                'permintaan_id' => 7,
                'bahan_id' => 2, 
                'jumlah_diminta' => 40,
            ],
            [
                'id' => 20,
                'permintaan_id' => 7,
                'bahan_id' => 6, 
                'jumlah_diminta' => 30,
            ],
            
            [
                'id' => 21,
                'permintaan_id' => 8,
                'bahan_id' => 1,
                'jumlah_diminta' => 35,
            ],
            [
                'id' => 22,
                'permintaan_id' => 8,
                'bahan_id' => 8,
                'jumlah_diminta' => 25,
            ],
            [
                'id' => 23,
                'permintaan_id' => 8,
                'bahan_id' => 3,
                'jumlah_diminta' => 20,
            ],
            
            [
                'id' => 24,
                'permintaan_id' => 9,
                'bahan_id' => 1,
                'jumlah_diminta' => 45,
            ],
            [
                'id' => 25,
                'permintaan_id' => 9,
                'bahan_id' => 5,
                'jumlah_diminta' => 25,
            ],
            [
                'id' => 26,
                'permintaan_id' => 9,
                'bahan_id' => 6,
                'jumlah_diminta' => 30,
            ],
            
            [
                'id' => 27,
                'permintaan_id' => 10,
                'bahan_id' => 1, 
                'jumlah_diminta' => 60,
            ],
            [
                'id' => 28,
                'permintaan_id' => 10,
                'bahan_id' => 3,
                'jumlah_diminta' => 50,
            ],
            [
                'id' => 29,
                'permintaan_id' => 10,
                'bahan_id' => 10,
                'jumlah_diminta' => 10,
            ],
        ];

        foreach ($permintaanDetail as $detail) {
            DB::table('permintaan_detail')->insert($detail);
        }
    }
}