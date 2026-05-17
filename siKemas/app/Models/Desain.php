<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desain extends Model
{
    use HasFactory;

    protected $fillable = [
        'produk_id',
        'jenis_kemasan_id',
        'palet_warna_id',
        'judul_desain',
        'status_desain',
        'preview_file',
        'teks_ai',
    ];

    // Relasi ke Produk
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    // Relasi ke JenisKemasan
    public function jenisKemasan()
    {
        return $this->belongsTo(JenisKemasan::class);
    }

    // Relasi ke PaletWarna
    public function paletWarna()
    {
        return $this->belongsTo(PaletWarna::class);
    }

    // Relasi ke PengaturanDesain
    public function pengaturanDesain()
    {
        return $this->hasOne(PengaturanDesain::class);
    }

    // Relasi ke Elemen
    public function elemens()
    {
        return $this->hasMany(Elemen::class);
    }

    // Relasi ke HasilEkspor
    public function hasilEkspors()
    {
        return $this->hasMany(HasilEkspor::class);
    }
}