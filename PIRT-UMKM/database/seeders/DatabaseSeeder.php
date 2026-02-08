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
           USERS
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

        $petugasId = DB::table('users')->insertGetId([
            'name' => 'Petugas Inspeksi',
            'email' => 'petugas@pirt.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'alamat' => 'Kota Batu',
            'no_hp' => '0811111111',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $users = [];
        for ($i = 1; $i <= 5; $i++) {
            $users[] = DB::table('users')->insertGetId([
                'name' => "UMKM User {$i}",
                'email' => "user{$i}@pirt.test",
                'password' => Hash::make('password'),
                'role' => 'user',
                'alamat' => 'Kota Batu',
                'no_hp' => '08900000' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        /* ======================
           USAHA
        ====================== */
        $usahaList = [];
        foreach ($users as $index => $userId) {
            $usahaList[] = DB::table('usaha')->insertGetId([
                'user_id' => $userId,
                'nama_usaha' => 'Usaha Kuliner ' . ($index + 1),
                'alamat_usaha' => 'Jl. Mawar No.' . ($index + 1),
                'jenis_usaha' => 'Makanan / Minuman',
                'izin_usaha' => 'PIRT-00' . ($index + 1),
                'tanggal_berdiri' => Carbon::now()->subYears(rand(3, 10)),
                'hasil_inspeksi' => 'Memenuhi Syarat',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        /* ======================
           PRODUK
        ====================== */
        foreach ($usahaList as $usahaId) {
            for ($i = 1; $i <= 3; $i++) {
                DB::table('produk')->insert([
                    'usaha_id' => $usahaId,
                    'nama_produk' => "Produk {$i}",
                    'komposisi' => 'Bahan alami pilihan',
                    'berat_bersih' => rand(100, 500),
                    'kemasan' => 'Plastik / Botol',
                    'tanggal_input' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        /* ======================
           VARIABEL INSPEKSI
        ====================== */
        $variabel = [
            ['A', 'Lokasi & Lingkungan', 1, 'Lingkungan bersih', 2],
            ['A', 'Lokasi & Lingkungan', 2, 'Bebas pencemaran', 2],
            ['B', 'Bangunan', 3, 'Bangunan layak', 3],
            ['B', 'Bangunan', 4, 'Ventilasi cukup', 2],
            ['C', 'Peralatan', 5, 'Peralatan bersih', 3],
            ['C', 'Peralatan', 6, 'Peralatan food grade', 2],
            ['D', 'Higiene', 7, 'Pekerja bersih', 3],
            ['D', 'Higiene', 8, 'Cuci tangan tersedia', 2],
        ];

        foreach ($variabel as $v) {
            DB::table('variabel')->insert([
                'kode_kategori' => $v[0],
                'nama_kategori' => $v[1],
                'nomor_variabel' => $v[2],
                'deskripsi' => $v[3],
                'bobot' => $v[4],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        /* ======================
           INSPEKSI & DETAIL
        ====================== */
        $variabelList = DB::table('variabel')->get();

        foreach ($usahaList as $usahaId) {
            $inspeksiId = DB::table('inspeksi')->insertGetId([
                'usaha_id' => $usahaId,
                'petugas_id' => $petugasId,
                'tanggal_inspeksi' => Carbon::now()->subDays(rand(1, 60)),
                'total_nilai' => 0,
                'kesimpulan' => 'Memenuhi Syarat',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $totalNilai = 0;

            foreach ($variabelList as $item) {
                $jawaban = rand(0, 1) ? 'ya' : 'tidak';
                $nilai = $jawaban === 'ya' ? $item->bobot : 0;
                $totalNilai += $nilai;

                DB::table('inspeksi_detail')->insert([
                    'inspeksi_id' => $inspeksiId,
                    'variabel_id' => $item->id,
                    'jawaban' => $jawaban,
                    'nilai' => $nilai,
                    'bobot' => $item->bobot,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::table('inspeksi')
                ->where('id', $inspeksiId)
                ->update(['total_nilai' => $totalNilai]);
        }
    }
}
