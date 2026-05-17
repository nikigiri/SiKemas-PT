<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elemen extends Model
{
    use HasFactory;

    protected $fillable = [
        'desain_id',
        'tipe_elemen',
        'teks',
        'font',
        'warna',
        'sumbu_x',
        'sumbu_y',
        'rotasi',
        'urutan',
    ];

    // Relasi ke Desain
    public function desain()
    {
        return $this->belongsTo(Desain::class);
    }
}