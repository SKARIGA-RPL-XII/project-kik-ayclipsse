<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $table = 'dokumen';

    protected $fillable = [
        'produk_id',
        'jenis_dokumen',
        'file_dokumen',
        'tanggal_input'
    ];

    // dokumen milik satu produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    // satu dokumen satu verifikasi
    public function verifikasi()
    {
        return $this->hasOne(Verifikasi::class, 'dokumen_id');
    }
}
