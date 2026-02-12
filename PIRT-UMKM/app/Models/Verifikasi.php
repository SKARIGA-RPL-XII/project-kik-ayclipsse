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

    // verifikasi milik satu dokumen
    public function dokumen()
    {
        return $this->belongsTo(Dokumen::class, 'dokumen_id');
    }

    // verifikasi bisa punya satu sertifikat
    public function sertifikat()
    {
        return $this->hasOne(Sertifikat::class, 'verifikasi_id');
    }
}
