<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumentasiKegiatan extends Model
{
    use HasFactory;


    protected $fillable = [
        'dokumentasi',
        'keterangan',
        'formulir_id'
    ];

    public function formulir()
    {
        return $this->belongsTo(Formulir::class, 'formulir_id', 'id');
    }
}
