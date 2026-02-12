<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Usaha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {

            return view('dashboard', [
                'totalUsaha'       => Usaha::count(),
                'totalProduk'      => Produk::count(),
                'totalPersetujuan' => Usaha::where('status', 'disetujui')->count(),
                'role'             => 'admin'
            ]);
        }

        $user = Auth::user();

        $usahaUser = Usaha::where('user_id', $user->id)->pluck('id');

        $totalUsaha = Usaha::where('user_id', $user->id)->count();

        $totalProduk = Produk::whereIn('usaha_id', $usahaUser)->count();

        $totalDisetujui = Produk::whereIn('usaha_id', $usahaUser)
            ->where('status', 'disetujui')
            ->count();

        $produkTerbaru = Produk::whereIn('usaha_id', $usahaUser)
            ->latest()
            ->take(3)
            ->get();

        $profilUsaha = Usaha::where('user_id', $user->id)->first();
        $role = 'user';
        return view('dashboard', compact(
            'totalUsaha',
            'usahaUser',
            'totalProduk',
            'totalDisetujui',
            'produkTerbaru',
            'profilUsaha',
            'role'

        ));
    }
}
