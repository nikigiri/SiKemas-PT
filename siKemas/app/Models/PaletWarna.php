<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaletWarna extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_palet',
        'warna_utama',
        'warna_sekunder',
        'warna_aksen',
        'kode_hex',
    ];

    // Relasi ke Desain
    public function desains()
    {
        return $this->hasMany(Desain::class);
    }
}