<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulir extends Model
{
    use HasFactory;


    protected $fillable = [
        'nama_formulir',
        'tanggal_dibuat'
    ];

    // protected $dates = [
    //     'tanggal_dibuat'
    // ];


    public function domain()
    {
        return $this->hasMany(Domain::class);
    }
}
