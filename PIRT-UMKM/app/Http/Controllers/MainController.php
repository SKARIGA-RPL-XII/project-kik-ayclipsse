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

        // ================= USER =================
        $usaha = Usaha::where('user_id', $user->id)->get();

        return view('dashboard', [
            'usaha' => $usaha,
            'role'  => 'user'
        ]);
    }
    

}
