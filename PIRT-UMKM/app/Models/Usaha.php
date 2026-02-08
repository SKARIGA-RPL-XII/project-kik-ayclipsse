<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usaha extends Model
{
    protected $table = 'usaha';

    protected $fillable = [
        'user_id',
        'nama_usaha',
        'alamat_usaha',
        'jenis_usaha',
        'izin_usaha',
        'tanggal_berdiri',
        'hasil_inspeksi',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produk()
    {
        return $this->hasMany(Produk::class);
    }

    public function inspeksi()
    {
        return $this->hasMany(Inspeksi::class);
    }
}
