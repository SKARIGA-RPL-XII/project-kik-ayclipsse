<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $table = 'dokumen';
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function verifikasi()
    {
        return $this->hasOne(Verifikasi::class, 'dokumen_id');
    }
}
