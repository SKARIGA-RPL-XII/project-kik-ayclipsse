<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variable extends Model
{
       protected $table = 'variable';

    protected $fillable = [
        'kode_kategori',
        'nama_kategori',
        'nomor_variabel',
        'deskripsi',
        'bobot'
    ];
}
