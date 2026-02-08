<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Usaha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profil()
    {
        $user = Auth::user();

        $usaha = $user->usaha()->with([
            'inspeksi.details.variable'
        ])->first();

        return view('user/usaha/profil', compact('user', 'usaha'));
    }
    public function profilUpdate(Request $request, $id)
    {
        $request->validate([
            'nama_usaha'      => 'required|string|max:255',
            'alamat_usaha'    => 'required|string',
            'jenis_usaha'     => 'required|string|max:100',
            'tanggal_berdiri' => 'required|date',
        ]);

        $usaha = Usaha::findOrFail($id);
        $usaha->update($request->all());

        return redirect()->back()->with('success', 'Profil usaha berhasil diperbarui');
    }

    public function produk(Request $request)
    {
        $user = Auth::user();
        $usaha = $user->usaha()->first();

        if (!$usaha) {
            if ($request->ajax()) {
                return response()->json([]);
            }
            return view('user.produk.produk', [
                'usaha' => null,
                'produk' => collect()
            ]);
        }

        $query = $usaha->produk()->with('verifikasi');

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_produk', 'like', '%' . $request->q . '%')
                    ->orWhere('komposisi', 'like', '%' . $request->q . '%')
                    ->orWhere('kemasan', 'like', '%' . $request->q . '%');
            });
        }

        $produk = $query->get();

        if ($request->ajax()) {
            return response()->json($produk);
        }

        return view('user.produk.produk', compact('usaha', 'produk'));
    }
    public function produkUpdate(Request $request, $id)
    {
        $request->validate([
            'nama_produk'  => 'required',
            'komposisi'    => 'required',
            'kemasan'      => 'required',
            'berat_bersih' => 'required|numeric'
        ]);

        Produk::findOrFail($id)->update($request->all());

        return redirect()->back()->with('success', 'P roduk berhasil diperbarui');
    }
}
