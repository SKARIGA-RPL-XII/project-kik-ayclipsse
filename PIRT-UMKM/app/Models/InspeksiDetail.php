<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InspeksiDetail extends Model
{
    protected $table = 'inspeksi_detail';

    protected $fillable = [
        'inspeksi_id',
        'variabel_id',
        'jawaban',
        'nilai',
        'bobot'
    ];

    public function variabel()
    {
        return $this->belongsTo(Variabel::class);
    }
}
