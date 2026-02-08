<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inspeksi extends Model
{
     protected $table = 'inspeksi';

    protected $fillable = [
        'usaha_id',
        'petugas_id',
        'tanggal_inspeksi',
        'total_nilai',
        'kesimpulan'
    ];

    public function details()
    {
        return $this->hasMany(InspeksiDetail::class);
    }
}
