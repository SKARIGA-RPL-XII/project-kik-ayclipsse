<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Produk;
use App\Models\Usaha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
    public function usaha()
    {
        return view('user.usaha.pendaftaran');
    }

    public function usahaStore(Request $request)
    {
        $request->validate([
            'nama_usaha'      => 'required|string|max:255',
            'jenis_produk'    => 'required|string|max:255',
            'alamat_usaha'    => 'required|string',
            'tanggal_berdiri' => 'required|date',
            'logo'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $logoPath = null;

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logo_usaha', 'public');
        }

        Usaha::create([
            'user_id'         => Auth::id(),
            'nama_usaha'      => $request->nama_usaha,
            'jenis_usaha'     => $request->jenis_produk,
            'alamat_usaha'    => $request->alamat_usaha,
            'tanggal_berdiri' => $request->tanggal_berdiri,
            'logo'            => $logoPath,
        ]);

        return redirect()->route('user.produk.pendaftaran')
            ->with('success', 'Usaha berhasil didaftarkan');
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

        // 1️⃣ Ambil usaha milik user
        $usaha = $user->usaha()->first();

        if (!$usaha) {
            return $request->ajax()
                ? response()->json([])
                : view('user.produk.produk', [
                    'usaha'  => null,
                    'produk' => collect()
                ]);
        }

        // 2️⃣ Query produk sesuai ERD
        $query = $usaha->produk();


        // 3️⃣ Search
        if ($request->filled('q')) {
            $keyword = $request->q;

            $query->where(function ($q) use ($keyword) {
                $q->where('nama_produk', 'like', "%{$keyword}%")
                    ->orWhere('komposisi', 'like', "%{$keyword}%")
                    ->orWhere('kemasan', 'like', "%{$keyword}%");
            });
        }

        $produk = $query->orderBy('created_at', 'desc')->get();

        // 4️⃣ Response AJAX (rapi & aman)
        if ($request->ajax()) {
            return response()->json(
                $produk->map(function ($item) {
                    return [
                        'id'               => $item->id,
                        'nama_produk'      => $item->nama_produk,
                        'komposisi'        => $item->komposisi,
                        'berat_bersih'     => $item->berat_bersih,
                        'kemasan'          => $item->kemasan,
                        'status_verifikasi' => $item->verifikasi->hasil_verifikasi ?? null,
                        'jumlah_dokumen'   => $item->dokumen->count(),
                    ];
                })
            );
        }

        // 5️⃣ View biasa
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
    public function pendaftaranProduk()
    {
        $user = Auth::user();
        $usaha = $user->usaha()->first();

        if (!$usaha) {
            return redirect()->back()->with('error', 'Usaha belum terdaftar');
        }

        return view('user.produk.pendaftaran', compact('usaha'));
    }
    public function pendaftaranProdukStore(Request $request)
    {
        $request->validate([
            'produk.*.nama_produk'   => 'required|string|max:255',
            'produk.*.komposisi'     => 'required|string',
            'produk.*.kemasan'       => 'required|string|max:255',
            'produk.*.berat_bersih'  => 'required|numeric|min:1',
            'produk.*.image'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();
        $usaha = $user->usaha()->first();

        if (!$usaha) {
            return back()->with('error', 'Usaha tidak ditemukan');
        }

        foreach ($request->produk as $index => $data) {

            $imagePath = null;

            if ($request->hasFile("produk.$index.image")) {
                $imagePath = $request->file("produk.$index.image")
                    ->store('produk', 'public');
            }

            Produk::create([
                'usaha_id'      => $usaha->id,
                'nama_produk'   => $data['nama_produk'],
                'komposisi'     => $data['komposisi'],
                'kemasan'       => $data['kemasan'],
                'berat_bersih'  => $data['berat_bersih'],
                'image'         => $imagePath,
                'tanggal_input' => now(),
                'status'        => 'menunggu',
            ]);
        }

        return redirect()->route('dashboard')
            ->with('success', 'Produk berhasil didaftarkan!');
    }
    public function produkDestroy($id)
    {
        $produk = Produk::findOrFail($id);

        // Pastikan hanya milik user login
        if ($produk->usaha->user_id !== Auth::id()) {
            abort(403);
        }

        // Tidak boleh hapus jika sudah disetujui
        if ($produk->status === 'disetujui') {
            return redirect()->back()
                ->with('error', 'Produk yang sudah disetujui tidak dapat dihapus.');
        }

        // Hapus gambar jika ada
        if ($produk->image) {
            Storage::disk('public')->delete($produk->image);
        }

        $produk->delete();

        return redirect()->back()
            ->with('success', 'Produk berhasil dihapus.');
    }

    public function dashboard()
    {
        $user = Auth::user();

        $usaha = $user->usaha()->first();

        if (!$usaha) {
            return view('dashboard', [
                'usaha'   => null,
                'produk'  => collect(),
            ]);
        }

        $produk = $usaha->produk()->latest()->get();

        return view('dashboard', compact('usaha', 'produk'));
    }
}
