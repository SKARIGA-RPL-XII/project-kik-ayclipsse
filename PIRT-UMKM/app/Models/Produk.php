<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = [
        'usaha_id',
        'nama_produk',
        'image',
        'komposisi',
        'berat_bersih',
        'kemasan',
        'tanggal_input',
        'status'
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
}
