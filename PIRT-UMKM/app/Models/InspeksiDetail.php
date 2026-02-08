<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InspeksiDetail extends Model
{
 protected $table = 'inspeksi_detail';

    protected $fillable = [
        'inspeksi_id',
        'variable_id',
        'jawaban',
        'nilai',
        'bobot'
    ];

    public function variable()
    {
        return $this->belongsTo(Variable::class);
    }
}
