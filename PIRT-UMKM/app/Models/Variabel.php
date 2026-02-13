<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variabel extends Model
{
    protected $table = 'variabel';

    protected $fillable = [
        'kode_kategori',
        'nama_kategori',
        'nomor_variabel',
        'deskripsi',
        'bobot'
    ];
}
