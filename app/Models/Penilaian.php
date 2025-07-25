<?php

namespace App\Models;

use App\Models\Formulir;
use App\Models\Indikator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penilaian extends Model
{
    use HasFactory;

    protected $fillable = [
        'indikator_id',
        'nilai',
        'catatan',
        'tanggal_penilaian',
        'user_id',
        'formulir_id',
        'bukti_dukung',
        'dikerjakan_by',
        'dikoreksi_by',
        'koreksi',
        'nilai_koreksi',
        'tanggal_dikoreksi',
    ];

    public function indikator()
    {
        return $this->belongsTo(Indikator::class, 'indikator_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function formulir()
    {
        return $this->belongsTo(Formulir::class);
    }

    public function dikerjakan_by()
    {
        return $this->belongsTo(User::class, 'dikerjakan_by');
    }

    public function dikoreksi_by()
    {
        return $this->belongsTo(User::class, 'dikoreksi_by');
    }


    protected $casts = [
        'user_id' => 'integer',
    ];

    // public static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         $model->user_id = auth()->id();
    //     });
    // }
}
