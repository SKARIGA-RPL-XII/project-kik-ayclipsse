<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = [
        'usaha_id',
        'nama_produk',
        'komposisi',
        'berat_bersih',
        'kemasan',
        'tanggal_input'
    ];

    // produk milik satu usaha
    public function usaha()
    {
        return $this->belongsTo(Usaha::class);
    }

    // produk punya banyak dokumen
    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'produk_id');
    }

    // akses verifikasi lewat dokumen (PENTING)
    public function verifikasi()
    {
        return $this->hasOneThrough(
            Verifikasi::class,
            Dokumen::class,
            'produk_id',   // FK di dokumen
            'dokumen_id',  // FK di verifikasi
            'id',          // PK produk
            'id'           // PK dokumen
        );
    }
}
