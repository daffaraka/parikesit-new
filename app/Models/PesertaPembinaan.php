<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaPembinaan extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'penjadwalan_id',
        'peserta_id'
    ];



    public function penjadwalan()
    {
        return $this->belongsTo(Penjadwalan::class, 'penjadwalan_id', 'id');
    }

    public function peserta()
    {
        return $this->belongsTo(User::class, 'peserta_id', 'id');
    }
}
