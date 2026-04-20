<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Usaha;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // --- LOGIC UNTUK ADMIN ---
        if ($user->role === 'admin') {

            // Logic Grafik 7 Hari Terakhir
            $chartLabels = [];
            $chartData = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i);
                $chartLabels[] = $date->translatedFormat('d M');
                $chartData[] = Usaha::whereDate('created_at', $date)->count();
            }

            return view('dashboard', [
                'totalUsaha'       => Usaha::count(),
                'totalProduk'      => Produk::count(),
                'totalPersetujuan' => Usaha::where('status', 'disetujui')->count(),
                'chartLabels'      => $chartLabels,
                'chartData'        => $chartData,
                'role'             => 'admin'
            ]);
        }

        // --- LOGIC UNTUK USER BIASA ---
        $usahaIds = Usaha::where('user_id', $user->id)->pluck('id');

        $totalUsaha     = $usahaIds->count();
        $totalProduk    = Produk::whereIn('usaha_id', $usahaIds)->count();
        $totalDisetujui = Produk::whereIn('usaha_id', $usahaIds)
            ->where('status', 'disetujui')
            ->count();

        $produkTerbaru  = Produk::whereIn('usaha_id', $usahaIds)
            ->latest()
            ->take(3)
            ->get();

        $profilUsaha    = Usaha::where('user_id', $user->id)->first();
        $role           = 'user';

        return view('dashboard', compact(
            'totalUsaha',
            'totalProduk',
            'totalDisetujui',
            'produkTerbaru',
            'profilUsaha',
            'role'
        ));
    }
}
