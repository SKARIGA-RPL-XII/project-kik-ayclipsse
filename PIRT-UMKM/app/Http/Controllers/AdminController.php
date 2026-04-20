<?php

namespace App\Http\Controllers;

use App\Models\Inspeksi;
use App\Models\InspeksiDetail;
use App\Models\Produk;
use App\Models\Usaha;
use App\Models\Variabel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    public function produkDetail(Produk $produk)
    {
        return view('admin.detail-produk', compact('produk'));
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

        // Logika Pencarian
        if ($request->filled('q')) {
            $searchTerm = '%' . $request->q . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nama_usaha', 'like', $searchTerm)
                    ->orWhere('jenis_usaha', 'like', $searchTerm)
                    ->orWhere('alamat_usaha', 'like', $searchTerm);
            });
        }

        // Ambil semua data (tanpa paginate)
        $usaha = $query->orderBy('id', 'desc')->get();

        // Response untuk AJAX
        if ($request->ajax()) {
            return response()->json(
                $usaha->map(function ($item) {
                    return [
                        'id'           => $item->id,
                        'nama_usaha'   => $item->nama_usaha,
                        'jenis_usaha'  => $item->jenis_usaha,
                        'alamat_usaha' => $item->alamat_usaha,
                        'status'       => $item->status, // Mengambil status asli dari database
                    ];
                })
            );
        }

        // Kirim data ke view
        return view('admin.usaha', compact('usaha'));
    }
    public function usahaDetail(Usaha $usaha)
    {
        // Ambil inspeksi terakhir usaha ini
        $inspeksi = Inspeksi::where('usaha_id', $usaha->id)
            ->latest()
            ->first();

        $details = collect();

        if ($inspeksi) {
            $details = InspeksiDetail::with('variabel')
                ->where('inspeksi_id', $inspeksi->id)
                ->get()
                ->groupBy(function ($item) {
                    return $item->variabel->nama_kategori;
                });
        }

        return view('admin.detail-usaha', compact('usaha', 'details'));
    }
    public function editInspeksi(Usaha $usaha)
    {
        $inspeksi = Inspeksi::where('usaha_id', $usaha->id)
            ->latest()
            ->first();

        $details = collect();

        if ($inspeksi) {
            $details = InspeksiDetail::with('variabel')
                ->where('inspeksi_id', $inspeksi->id)
                ->get()
                ->groupBy(function ($item) {
                    return optional($item->variabel)->nama_kategori ?? 'Lainnya';
                });
        }

        return view('admin.edit-inspeksi', compact('usaha', 'details'));
    }
    public function inspeksiUpdate(Request $request, Usaha $usaha)
    {
        // 1. Validasi (Opsional tapi disarankan)
        $request->validate([
            'bobot' => 'required|array',
            'jawaban' => 'required|array',
        ]);

        // 2. Ambil data induk inspeksi
        $inspeksi = Inspeksi::where('usaha_id', $usaha->id)->latest()->first();

        if (!$inspeksi) {
            return redirect()->back()->with('error', 'Data inspeksi tidak ditemukan.');
        }

        try {
            DB::transaction(function () use ($request, $inspeksi) {
                $totalNilai = 0;

                // 3. Loop data berdasarkan input jawaban (ID detail sebagai key)
                foreach ($request->jawaban as $id => $jawaban) {
                    $detail = InspeksiDetail::findOrFail($id);

                    // Ambil bobot dari form (jika diubah)
                    $bobotBaru = $request->bobot[$id];

                    // Logika Nilai: Jika 'ya' ambil bobot, jika 'tidak' maka 0
                    $nilaiBaru = ($jawaban == 'ya') ? $bobotBaru : 0;

                    $detail->update([
                        'bobot'   => $bobotBaru,
                        'jawaban' => $jawaban,
                        'nilai'   => $nilaiBaru
                    ]);

                    $totalNilai += $nilaiBaru;
                }

                // 4. Update Total Nilai di tabel Inspeksi Utama
                $inspeksi->update([
                    'total_nilai' => $totalNilai,
                    // 'updated_at' otomatis terupdate oleh Eloquent
                ]);
            });

            return redirect()->route('admin.usaha.detail', $usaha->id)
                ->with('success', 'Data inspeksi berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
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
        $search = $request->get('q');

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


        return view('admin.persetujuan', compact('data'));
    }

    public function usahaStatus(Request $request, Usaha $usaha)
    {
        // Mengambil nilai 'disetujui' atau 'ditolak' dari atribut 'value' tombol yang diklik
        $status = $request->status;

        try {
            DB::transaction(function () use ($status, $usaha) {
                // Update status usaha
                $usaha->update(['status' => $status]);

                // Jika disetujui, buat record inspeksi dan salin variabel
                if ($status === 'disetujui') {
                    $inspeksi = Inspeksi::create([
                        'usaha_id' => $usaha->id,
                        'petugas_id' => Auth::id(),
                        'tanggal_inspeksi' => now(),
                        'total_nilai' => 0
                    ]);

                    $variabel = Variabel::all();
                    foreach ($variabel as $v) {
                        InspeksiDetail::create([
                            'inspeksi_id' => $inspeksi->id,
                            'variabel_id' => $v->id,
                            'jawaban'     => 'tidak',
                            'bobot'       => $v->bobot,
                            'nilai'       => 0
                        ]);
                    }
                }
            });

            return back()->with('success', 'Status berhasil diperbarui!');
        } catch (\Exception $e) {
            return $e->getMessage();
            return back()->with('error', 'Gagal: ' . $e->getMessage());
        }
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
