<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Verifikasi extends Model
{
    protected $table = 'verifikasi';

    protected $fillable = [
        'dokumen_id',
        'tanggal_verifikasi',
        'hasil_verifikasi',
        'keterangan'
    ];
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
    public function dokumen()
    {
        return $this->belongsTo(Dokumen::class, 'dokumen_id');
    }

    public function sertifikat()
    {
        return $this->hasOne(Sertifikat::class);
    }
}
