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
        $query = Produk::with('usaha');

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
                        'verifikasi' => $item->status // langsung dari kolom produk
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

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_usaha', 'like', '%' . $request->q . '%')
                    ->orWhere('jenis_usaha', 'like', '%' . $request->q . '%')
                    ->orWhere('alamat_usaha', 'like', '%' . $request->q . '%');
            });
        }

        if ($request->ajax()) {
            return response()->json(
                $query->orderBy('id', 'desc')->get()->map(function ($item) {
                    return [
                        'id'           => $item->id,
                        'nama_usaha'   => $item->nama_usaha,
                        'jenis_usaha'  => $item->jenis_usaha,
                        'alamat_usaha' => $item->alamat_usaha,
                        'status'       => 'Terdaftar PIRT',
                    ];
                })
            );
        }

        $usaha = $query
            ->orderBy('id', 'desc')
            ->paginate(5)
            ->withQueryString();

        return view('admin.usaha', compact('usaha'));
    }
    public function usahaDestroy($id)
    {
        $usaha = Usaha::findOrFail($id);
        $usaha->delete();

        return response()->json([
            'success' => true
        ]);
    }
    public function persetujuan(Request $request)
    {
        $type   = $request->get('type', 'usaha');
        $search = $request->get('q');

        if ($type === 'produk') {

            $query = Produk::with('usaha')
                ->where('status', 'menunggu');

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_produk', 'like', "%{$search}%")
                        ->orWhereHas('usaha', function ($u) use ($search) {
                            $u->where('nama_usaha', 'like', "%{$search}%")
                                ->orWhere('jenis_usaha', 'like', "%{$search}%");
                        });
                });
            }

            $data = $query->latest()->get();

            if ($request->ajax()) {
                return response()->json(
                    $data->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'type' => 'produk',
                            'nama_usaha' => $item->usaha->nama_usaha,
                            'nama_produk' => $item->nama_produk,
                            'jenis' => $item->usaha->jenis_usaha,
                            'status' => $item->status,
                        ];
                    })
                );
            }
        } else {

            $query = Usaha::where('status', 'menunggu');

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_usaha', 'like', "%{$search}%")
                        ->orWhere('jenis_usaha', 'like', "%{$search}%");
                });
            }

            $data = $query->latest()->get();

            if ($request->ajax()) {
                return response()->json(
                    $data->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'type' => 'usaha',
                            'nama_usaha' => $item->nama_usaha,
                            'nama_produk' => '-',
                            'jenis' => $item->jenis_usaha,
                            'status' => $item->status,
                        ];
                    })
                );
            }
        }

        return view('admin.persetujuan', compact('data', 'type'));
    }



    public function usahaStatus(Request $request, Usaha $usaha)
    {
        $usaha->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status usaha berhasil diperbarui');
    }
    public function produkStatus(Request $request, Produk $produk)
    {
        $produk->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status produk berhasil diperbarui');
    }
    public function chartData()
    {
        $labels = [];
        $data = [];

        for ($i = 6; $i >= 0; $i--) {

            $date = now()->subDays($i);

            $labels[] = $date->format('d M');

            $count = Produk::whereDate('created_at', $date)->count();

            $data[] = $count;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }
}
