<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Usaha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    public function produk(Request $request)
    {
        $query = Produk::with([
            'usaha',
            'dokumen.verifikasi'
        ]);

        // 🔍 SEARCH REALTIME
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_produk', 'like', '%' . $request->q . '%')
                    ->orWhere('komposisi', 'like', '%' . $request->q . '%')
                    ->orWhere('kemasan', 'like', '%' . $request->q . '%')
                    ->orWhereHas('usaha', function ($u) use ($request) {
                        $u->where('nama_usaha', 'like', '%' . $request->q . '%')
                            ->orWhere('jenis_usaha', 'like', '%' . $request->q . '%');
                    });
            });
        }

        // ⚠️ JIKA AJAX (REALTIME SEARCH)
        if ($request->ajax()) {
            return response()->json(
                $query->get()->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'nama_produk' => $item->nama_produk,
                        'jenis_usaha' => $item->usaha->jenis_usaha ?? '-',
                        'komposisi' => $item->komposisi,
                        'berat_bersih' => $item->berat_bersih,
                        'kemasan' => $item->kemasan,
                        'verifikasi' => $item->verifikasi?->hasil_verifikasi
                    ];
                })
            );
        }

        $produk = $query->get();

        return view('admin.produk', compact('produk'));
    }
    public function produkModal($id)
    {
        $produk = Produk::with([
            'usaha',
            'dokumen.verifikasi'
        ])->findOrFail($id);

        $verifikasi = optional($produk->dokumen->first())->verifikasi;

        return response()->json([
            'nama_produk'   => $produk->nama_produk,
            'jenis_produk'  => $produk->usaha->jenis_usaha ?? '-',
            'nama_usaha'    => $produk->usaha->nama_usaha ?? '-',
            'komposisi'     => $produk->komposisi,
            'berat_bersih'  => $produk->berat_bersih,
            'kemasan'       => $produk->kemasan,
            'tanggal_input' => optional($produk->tanggal_input)->format('d F Y'),
            'verifikasi'    => $verifikasi?->hasil_verifikasi ?? 'menunggu',
        ]);
    }
    public function usaha(Request $request)
    {
        $query = Usaha::query();

        // 🔍 SEARCH REALTIME (SAMA SEPERTI PRODUK)
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_usaha', 'like', '%' . $request->q . '%')
                    ->orWhere('jenis_usaha', 'like', '%' . $request->q . '%')
                    ->orWhere('alamat_usaha', 'like', '%' . $request->q . '%');
            });
        }

        // ⚠️ JIKA AJAX → JSON (UNTUK SEARCH REALTIME)
        if ($request->ajax()) {
            return response()->json(
                $query->orderBy('id', 'desc')->get()->map(function ($item) {
                    return [
                        'id'           => $item->id,
                        'nama_usaha'   => $item->nama_usaha,
                        'jenis_usaha'  => $item->jenis_usaha,
                        'alamat_usaha' => $item->alamat_usaha,
                        'status'       => 'Terdaftar PIRT', // atau nanti dari relasi
                    ];
                })
            );
        }

        // 🧾 NORMAL LOAD (PAGINATION)
        $usaha = $query
            ->orderBy('id', 'desc')
            ->paginate(5)
            ->withQueryString();

        return view('admin.usaha', compact('usaha'));
    }
}
