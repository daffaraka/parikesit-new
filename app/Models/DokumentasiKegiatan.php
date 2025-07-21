<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumentasiKegiatan extends Model
{
    use HasFactory;


    protected $fillable = [
        'created_by_id',
        'judul_dokumentasi',
        'bukti_dukung_undangan_dokumentasi',
        'daftar_hadir_dokumentasi',
        'materi_dokumentasi',
        'notula_dokumentasi',
    ];


   public function profile()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
