<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /* ======================
           USER
        ====================== */
        $adminId = DB::table('users')->insertGetId([
            'name' => 'Admin PIRT',
            'email' => 'admin@pirt.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'alamat' => 'Dinas Kesehatan Kota Batu',
            'no_hp' => '081234567890',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $userId = DB::table('users')->insertGetId([
            'name' => 'Raysha',
            'email' => 'user@pirt.test',
            'password' => Hash::make('password'),
            'role' => 'user',
            'alamat' => 'Kota Batu',
            'no_hp' => '0899999999',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /* ======================
           USAHA
        ====================== */
        $usahaId = DB::table('usaha')->insertGetId([
            'user_id' => $userId,
            'nama_usaha' => 'DAPUR NUSANTARA',
            'alamat_usaha' => 'Jl. Kamboja Atas, Kota Batu',
            'jenis_usaha' => 'Makanan / Minuman',
            'izin_usaha' => 'PIRT-123456',
            'tanggal_berdiri' => '2015-01-14',
            'hasil_inspeksi' => 'Memenuhi Syarat',
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /* ======================
           PRODUK
        ====================== */
        $produkId = DB::table('produk')->insertGetId([
            'usaha_id' => $usahaId,
            'nama_produk' => 'Jamu Djeng Nita',
            'komposisi' => 'Jahe, kunyit, gula aren',
            'berat_bersih' => 250,
            'kemasan' => 'Botol',
            'tanggal_input' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /* ======================
           VARIABEL INSPEKSI
        ====================== */
        $variabel = [
            [
                'kode_kategori' => 'A',
                'nama_kategori' => 'Lokasi dan Lingkungan Produksi',
                'nomor_variabel' => 1,
                'deskripsi' => 'Lingkungan produksi bersih dan terawat',
                'bobot' => 2,
            ],
            [
                'kode_kategori' => 'B',
                'nama_kategori' => 'Bangunan dan Fasilitas',
                'nomor_variabel' => 2,
                'deskripsi' => 'Bangunan layak dan mudah dibersihkan',
                'bobot' => 3,
            ],
        ];

        foreach ($variabel as $v) {
            DB::table('variabel')->insert([
                ...$v,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        /* ======================
           INSPEKSI
        ====================== */
        $inspeksiId = DB::table('inspeksi')->insertGetId([
            'usaha_id' => $usahaId,
            'petugas_id' => $adminId,
            'tanggal_inspeksi' => Carbon::now(),
            'total_nilai' => 5,
            'kesimpulan' => 'Memenuhi syarat PIRT',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /* ======================
           INSPEKSI DETAIL
        ====================== */
        $variabelList = DB::table('variabel')->get();

        foreach ($variabelList as $item) {
            DB::table('inspeksi_detail')->insert([
                'inspeksi_id' => $inspeksiId,
                'variabel_id' => $item->id,
                'jawaban' => 'tidak',
                'nilai' => $item->bobot,
                'bobot' => $item->bobot,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
