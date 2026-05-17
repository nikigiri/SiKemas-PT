<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_produk',
        'tagline',
        'deskripsi_produk',
        'kategori_produk',
        'gambar_logo',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Desain
    public function desains()
    {
        return $this->hasMany(Desain::class);
    }
}
