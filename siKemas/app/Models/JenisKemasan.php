<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKemasan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kemasan',
        'deskripsi_kemasan',
        'ikon_kemasan',
    ];

    // Relasi ke Desain
    public function desains()
    {
        return $this->hasMany(Desain::class);
    }
}