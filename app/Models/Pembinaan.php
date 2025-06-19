<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembinaan extends Model
{
    use HasFactory;


    protected $fillable = [
        'profile_id',
        'peserta_id',
        'penjadwalan_id',
        'judul_pembinaan',
        'tanggal_pembinaan',
        'ringkasan_pembinaan',
        'bukti_pembinaan',
        'pemateri',
    ];

    public function profile()
    {
        return $this->belongsTo(User::class, 'profile_id');
    }

    public function peserta()
    {
        return $this->belongsTo(PesertaPembinaan::class, 'peserta_id');
    }

    public function penjadwalan()
    {
        return $this->belongsTo(Penjadwalan::class, 'penjadwalan_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
